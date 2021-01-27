<?php
require_once '../init.php';
if (Input::exists()) {
    if (token::check(input::get('token'))) {//protect against csrf
        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'username' => array(
                'required' => true,
                'min' => 4,
                'max' => 20,
                'unique' => 'users'
            ),
            'email' => array(
                'required' => true,
                'valid' => true,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6,
                'upper' => true
            ),
            'repeat_password' => array(
                'required' => true,
                'matches' => 'password'
            )
        ));
        if ($validation->passed()) {
            $user = new user();
            $salt = hash::salt(32);
            $code = hash::salt(32);
            
            try {
                $user->create(array(
                    'username' => input::get('username'),
                    'password' => hash::make(input::get('password'), $salt),
                    'salt' => $salt,
                    'email' => input::get('email'),
                    'verification_token' => $code,
                    'verified' => 0,
                    'comment_email' => 1
                ));

                $result = $user->find(input::get('username'));
                if ($result) {
                $results = $user->data();
                $saltcode = $results->verification_token;
                $user->update($results->id, array(
                    'password' => hash::make(input::get('password'), $results->salt),
                    'verification_token' => hash::make('code', $saltcode)               
                ));
                $code = hash::make('code', $saltcode);
            }
        
                if ($validation->send_email(input::get('email'), $code, null, null)) {
                    session::flash('email', 'Please check your email');
                    redirect::to('../register_page.php');
                }
            } catch (Exception $e) {
                die ($e->getMessage());
            }

            
        } else {
            $error = $validation->errors();
            session::flash('error', $error[0] . '<br>');
            redirect::to('../register_page.php');
        }
    }
}