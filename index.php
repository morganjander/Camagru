
<?php
    require_once 'init.php';
    $user = Dbh::getInstance()->delete('users', array('username', '=', 'billy'));
    if (!$user->count()) {
        echo 'No user';
    }
    else {
        echo 'OK';
    }
    

