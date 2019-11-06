<?php
require_once '../init.php';
$user = new user();

if (!$user->isLoggedIn() && (empty($_GET['code']) || empty($_GET['user']))){
    redirect::to('../index.php');
}
else if (!$user->isLoggedIn()){
    $result = $user->find($_GET['user']);
    if ($result) {
        $results = $user->data();
        $token = $results->verification_token;
        if ($token != $_GET['code']) {
            redirect::to('../index.php');
    }
}
} else {
    $results = $user->data();
}
if (Input::exists()) {
    if (token::check(input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
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
                try {
                        $user->update($results->id, array(
                        'password' => hash::make(input::get('password'), $results->salt)
                        ));
                        session::flash('updated', 'Password updated successfully');
                        if ($user->isLoggedIn()) {
                            redirect::to('../profile.php');
                        } else {
                            redirect::to('../login.php');
                        }
                        
                        
                } catch (Exception $e) {
                    die ($e->getMessage());
                }


            } else {
                $error = $validation->errors();
                session::flash('reset_error', $error[0] . '<br>');
                redirect::to('../password_reset.php');
            }

    }
}