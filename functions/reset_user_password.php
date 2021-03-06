<?php
require_once '../init.php';
$user = new user();

if (!$user->isLoggedIn()){
    $result = $user->find($_POST['user']);
    if ($result) {
        $results = $user->data();
        $token = $results->verification_token;
       if ($token != $_POST['code']) {
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
                        session::flash('password_updated', 'Password updated successfully');
                        redirect::to('../password_reset_page.php');                        
                        
                } catch (Exception $e) {
                    die ($e->getMessage());
                }


            } else {
                $error = $validation->errors();
                session::flash('reset_error', $error[0] . '<br>');
                redirect::to('../password_reset_page.php');
            }

    }
 }