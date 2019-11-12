<?php
    require_once 'init.php';
    
    $user = new user();
    if ($user->isLoggedIn()) {
        $image = new image();
        $filename = input::get('image');
        $user = input::get('user');

        echo "<div class = 'box column is-5 is-offset-one-quarter'>
                <img src='../uploads/".$filename."'/>
                <br />
                </div>";
        // try {
        //     $image->add_comment($filename, $user);
        //     redirect::to('../index.php');
        // } catch (Exception $e) {
        //     die ($e->getMessage());
        // }
        

    } else {
        session::flash('login to like', 'Please login or register to like or comment on photos');
        redirect::to('../index.php');
    }