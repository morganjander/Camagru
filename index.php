
<?php
    require_once 'init.php';
    $user = Dbh::getInstance()->get('users', array('id', '>', '0'));
    if (!$user->count()) {
        echo 'No user';
    }
    else {
           foreach ($user->results() as $user) {
            echo $user->username, '<br>';
        }
    }
    

