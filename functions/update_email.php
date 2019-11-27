<?php
    require_once '../init.php';
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('../index.php');
    }
    if (Input::exists()) {
        if (token::check(input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'email' => array(
                    'required' => true,
                    'valid' => true,
                    'unique' => 'users'
                )
            ));
            if ($validation->passed()) {
                $code = hash::salt(32);
                $result = $user->find(session::get('user'));
            if ($result) {
                $results = $user->data();
                $saltcode = $results->verification_token;
            try {
                $user->update($results->id, array(
                    'email' => input::get('email'), 
                    'verification_token' => hash::make('code', $saltcode),
                    'verified' => 0 //because retrieving salt from the database changes it argh                 
                ));
                $code = hash::make('code', $saltcode);
                if ($validation->send_email(input::get('email'), $code, null, null)) {
                        session::flash('email', 'Please check your email');
                        redirect::to('../email_reset_page.php');
                    }
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            }
        }
    }
}
    ?>