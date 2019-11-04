<?php
class Validate {
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct() {
        $this->_db = Dbh::getInstance();
    }

    public function check($source, $items = array()) {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $item = escape($item);
                
                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters");
                            }

                        break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters");
                            }
                        break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} must match {$item}");
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("{$item} already exists");
                            }
                        break;
                        case 'upper':
                            if (ctype_lower($value)) {
                               $this->addError("{$item} must contain uppercase letters");
                            }
                        break;
                        case 'valid':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->addError("{$item} must be a valid email address");
                            }
                        break;
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error) {
        $this->_errors[] = $error;
    }

    public function errors() {
        return $this->_errors;
    }

    public function passed() {
        return $this->_passed;
    }

    public function send_email($to, $code, $reset = null) {
        if (!$reset) {

            $link = "http://localhost/Camagru/verify.php?code=" . $code . "&user=" . $to;
            $str = "";
            $str .= "Hi, Please click on ";
            $str .= "<a href='{$link}'>this link</a>";
            $str .= " to verify your account.";
       
            $subject  = 'Verify Camagru';
    } else {
            $link = "http://localhost/Camagru/update.php?code=" . $code . "&user=" . $to;
            $str = "";
            $str .= "Hi, Please click on ";
            $str .= "<a href='{$link}'>this link</a>";
            $str .= " to reset your password.";
       
            $subject  = 'Reset your Camagru password';

    }
        $message  = $str;
        $headers  = 'From: mjandercamagru@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
        if(mail($to, $subject, $message, $headers))
        return true;
        else
        return false;
    }

    public function verify_code($code, $sent_code) {
        if ($code === $sent_code) {
            return true;
        } 
        return false;
    }
    
}