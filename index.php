
<?php
    require_once 'init.php';

    // $user = Dbh::getInstance()->update('users', 9, array(
    //     'password' => 'oldpassword'));

 
   
   $user = Dbh::getInstance()->insert('users', array(
       'username' => 'Dale', 
       'password' => 'password', 
       'salt' => 'salt',
       'email' => 'test@test.com'));

    // $user = Dbh::getInstance()->get('users', array('id', '>', '0'));
    // if (!$user->count()) {
    //     echo 'No user';
    // }
    // else {
    //        foreach ($user->results() as $user) {
    //         echo $user->username, '<br>';
    //     }
    // }
    

