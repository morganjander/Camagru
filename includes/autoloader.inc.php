<?php
// print_r(PDO::getAvailableDrivers()); print the driver you are using
    spl_autoload_register('myAutoLoader');
    function myAutoLoader($classname){
        $path = "classes/";
        $extension = ".class.php";
        $fullpath = $path . $classname . $extension;

        if (!file_exists($fullpath)){
            return false;
       }
        include_once $fullpath;
    }