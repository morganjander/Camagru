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

    public function display_all() {
        $data = $this->_db->get('images', array('id', '>', 0), 'date_uploaded');
        if($data->count()){

            foreach ($data->results() as $data) {
                $imageURL = $data->filename;
                echo "<img src='uploads/".$imageURL."'/>";
            }
            
         } else{ 
            ?><p>No image(s) found...</p> <?php
         }
    }
}