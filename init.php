<?php
    session_start();
    include_once("includes/header.html");
    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => 'ROOT',
            'dbname' => 'db'
        ),
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 10800
        ),
        'session' => array(
            'session_name' => 'user'
        )

        );

    spl_autoload_register('myAutoLoader');
    function myAutoLoader($classname){
        $path = "classes/";
        $extension = ".class.php";
        $fullpath = $path . $classname . $extension;

        if (!file_exists($fullpath)){
            return false;
       }
        require_once $fullpath;
    }

    require_once 'functions/sanitise.php';