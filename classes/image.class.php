<?php

class image {

    private $_db,
            $_data,
            $_sessionName;
    public function __construct() {
        $this->_db = Dbh::getInstance();
        $this->_sessionName = config::get('session/session_name');
    }

    public function upload($fields = array()) {
        if(!$this->_db->insert('images', $fields)) {
            throw new Exception('Problem adding image');
        }
    }
}