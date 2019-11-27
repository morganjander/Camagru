<?php
    require_once '../init.php';
    ?>
    <br>
    <br>
    <br>
    <?php
    $user = new user();
    if (!$user->isLoggedIn()) {
        redirect::to('../index.php');
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
                    $name = htmlspecialchars(input::get('username'));
                    $user->update($user->data()->id, array(
                        'username' => $name
                    ));
                    session::put('user', input::get('username'));
                    session::flash('updated', 'Username updated succesfully');
                    redirect::to('../update_page.php');
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            } else {
                $error = $validation->errors();
                session::flash('error', $error[0] . '<br>');
                redirect::to('../update_page.php');
            }
        }
    }
    ?>