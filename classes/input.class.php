<?php
class input {

    public static function exists($type = 'post') {
        switch ($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            break;
            case 'get':
                return (!empty($_GET)) ? true : false;
            break;
            case 'files':
                return (!empty($_FILES)) ? true : false;
            break;
            default:
            return false;
            break;
        }
    }

    public static function get($item) {
        if (isset($_POST[$item])) {
            $text = htmlspecialchars($_POST[$item]);
            return $text;
        }
        else if (isset($_GET[$item])) {
            $text = htmlspecialchars($_GET[$item]);
            return $text; 
        }
        else if (isset($_FILES[$item])) {
            return $_FILES[$item]; 
        }
        return '';
    }
}