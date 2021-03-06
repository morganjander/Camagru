<?php
    session_start();
    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => 'ROOT',
            'dbname' => 'db', 
            'charset'=> 'utf8mb4'
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