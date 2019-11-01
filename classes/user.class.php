<?php

class User {

    private $_db;
    public function __construct($user = null) {
        $this->_db = Dbh::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('Problem creating account');
        }
    }
}