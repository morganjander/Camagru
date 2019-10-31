<?php
class token {
    public static function generate() {
        return session::put(config::get('session/token_name'), md5(uniqid()));
    }
}