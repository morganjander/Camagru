<?php
    require_once '../init.php';
    $user = new user();
    if (!$user->isLoggedIn()){
        session::flash('login to like', 'Please login or register to like or comment on photos');
        redirect::to('../index.php');
    } else {
        $filename = input::get('image');
        $image = new image();
        $owner = $image->get_photo($filename)->first()->user_id;
        $name = $user->data()->username;
        $id = $user->data()->id;
        $recipient = new user();
        if ($recipient->find($owner)) {
            $email = $recipient->data()->email;
        }
        if (input::get('comment')) {
                $text = input::get('comment');
                try {
                    $image->add_comment($filename, $id, $text);
                    if ($user->data()->comment_email) {
                        $validate = new validate();
                        $validate->send_email($email, null, null, $name);

                    }
                    redirect::to('back');
                } catch (Exception $e) {
                    die ($e->getMessage());
                }
            }
 }