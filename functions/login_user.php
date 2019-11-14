<?php
require_once '../init.php';
if (token::check(input::get('token'))) {
    
    $validate = new validate();
    $validation = $validate->check($_POST, array(
        'username' => array('required' => true),
        'password' => array('required' => true)
    ));

    if ($validation->passed()) {

        $user = new user();
        $login = $user->login(input::get('username'), input::get('password'));
        $result = $user->find(input::get('username'));
        if ($result) {
            $verified = $user->data()->verified;
        }

        if ($login && $verified) {
            redirect::to('../profile_page.php');
        } else if($login && !$verified) {
            session::flash('notverified', 'Please verify your email first');
            redirect::to('../login_page.php');
        } else {
            session::flash('notcorrect', 'Incorrect login details');
            redirect::to('../login_page.php');
        }

    } else {
        $error = $validation->errors();
        session::flash('loginerror', $error[0] . '<br>');
        redirect::to('../login_page.php');
    }
}

