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

    public function delete($id) {
        if(!$this->_db->delete('images', array('filename', '=', $id))) {
            throw new Exception('Problem deleting image');
        }
    }

    public function add_like ($filename, $user) {
        $data = $this->_db->get('images', array('filename', '=', $filename));
        if($data->count()) {
            $this->_data = $data->first();
            $likes = $this->_data->likes;
            $userliked = $this->_data->user_liked;
            if ($userliked === $user) {
                $likes--;
                $user = null;
            } else {
                $likes++;
            }
            $fields = array (
                'likes' => $likes,
                'user_liked' => $user
            );
        }
        $id = $this->_data->id;

        if (!$this->_db->update('images', $id, $fields)) {
            throw new Exception('Problem updating likes');
        }
    }

    public function add_comment ($filename, $user, $text) {
        $image = $this->_db->get('images', array('filename', '=', $filename));
        if($image->count()) {
            $this->_data = $image->first();
            $img_id = $this->_data->id;
            $fields = array (
                'img_id' => $img_id,
                'comment_text' => $text,
                'username' => $user
            );
        }

        if (!$this->_db->insert('comments', $fields)) {
            throw new Exception('Problem adding comment');
        }
    }
    
    public function get_all_photos() {
        $data = $this->_db->get_all('images', array('id', '>', 0), 'id DESC');
        return $data;

    }

    public function get_all_user_photos($user) {
        $data = $this->_db->get_all('images', array('username', '=', $user), 'id DESC');
        return $data;

    }

    public function get_photo($filename) {
        $photo = $this->_db->get('images', array('filename', '=', $filename));
        return $photo;
    }

    public function get_all_comments($id) {

        $comments = $this->_db->get('comments', array('img_id', '=', $id));
        return $comments;
    }
}