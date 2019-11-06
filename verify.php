<?php
require_once 'init.php';
if (empty($_GET['code']) || empty($_GET['user'])){
    redirect::to('index.php');
}
else {
    $user = new user();
    $result = $user->find($_GET['user']);
    if ($result) {
        $results = $user->data();
        $token = $results->verification_token;
        echo $token;
        if ($token === $_GET['code']) {
            $user->update($results->id, array(
                'verified' => 1
            ));
            session::flash('verified', 'Thank you, your account has been verified');
            redirect::to('index.php');
        }
        else {
            echo "uh-oh";
        }
    }
}


