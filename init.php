<?php
    session_start();
    include_once("includes/header.html");
    include_once("includes/footer.html");
    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => 'ROOT',
            'dbname' => 'db', 
            'charset'=> 'utf8mb4'
        ),
        'remember' => array(
            'cookie_name' => 'hash',
            'cookie_expiry' => 10800
        ),
        'session' => array(
            'session_name' => 'user',
            'token_name' => 'token'
        )

        );
        

    spl_autoload_register('myAutoLoader'); //automatically loads a class whenever it is instantiated
    function myAutoLoader($classname){
        $root = $_SERVER['DOCUMENT_ROOT']. "/" . "Camagru/";
        $path = "classes/";
        $extension = ".class.php";
        $fullpath = $root . $path . $classname . $extension;

        if (!file_exists($fullpath)){
            return false;
       }
        require_once $fullpath;
    }

    require_once 'functions/sanitise.php';