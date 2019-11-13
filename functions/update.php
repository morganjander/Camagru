<?php
    require_once 'init.php';
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('index.php');
    }
    if (Input::exists()) {
        if (token::check(input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                )
            ));
            if ($validation->passed()) {
                try {
                    $user->update($user->data()->id, array(
                        'username' => input::get('username')
                    ));
                    echo "Details updated successfully";
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            }
        }
    }
    ?>