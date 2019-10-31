<?php
class session {
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;        
    }
}