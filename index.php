
<?php
    session_start();
    include 'includes/autoloader.inc.php';
    include_once("header.html");

    
    $object = new User;
    $object->getAllUsers();
    ?>

