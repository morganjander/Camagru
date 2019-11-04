<?php

class User {

    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn = false;
    public function __construct($user = null) {
        $this->_db = Dbh::getInstance();
        $this->_sessionName = config::get('session/session_name');

        if (!$user) {
            if (session::exists($this->_sessionName)) {
                $user = session::get($this->_sessionName);

                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    //process logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('Problem creating account');
        }
    }

    public function update ($id, $fields = array()) {
        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('Problem updating account');
        }
    }

    public function find($user = null) {
        if($user) {
            if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            } else {
                $field = (is_numeric($user)) ? 'id' : 'username';
            }
            $data = $this->_db->get('users', array($field, '=', $user));
        }

        if($data->count()) {
            $this->_data = $data->first();
            return true;
        }
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public function login($username = null, $password = null) {

        $user = $this->find($username);
        if ($user) {
            if ($this->data()->password === hash::make($password, $this->data()->salt)) {
                session::put($this->_sessionName, $this->data()->id);
                return true;              
            }
        }

        return false;
    }

    public function logout() {
        session::delete($this->_sessionName);
    }
}