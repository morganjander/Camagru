<?php
    require_once '../init.php';
    
    $user = new user();
    if ($user->isLoggedIn()) {
        $image = new image();
        $filename = input::get('image');
        $user = input::get('user');
        try {
            $image->add_like($filename, $user);
            redirect::to('../index.php');
        } catch (Exception $e) {
            die ($e->getMessage());
        }
        

    } else {
        session::flash('login to like', 'Please login or register to like or comment on photos');
        redirect::to('../index.php');
    }