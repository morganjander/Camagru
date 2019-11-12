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


    public function display_all() {
        $data = $this->_db->get('images', array('id', '>', 0), 'date_uploaded ASC');
        
        if($data->count()){

            foreach ($data->results() as $data) {
                $imageURL = $data->filename;
                $uploader = $data->username;
                $id = $data->id;
                $likes = $data->likes;
                $text = "";
                $comments = $this->_db->get('comments', array('img_id', '=', $id));
                if ($comments->results()) {
                    foreach ($comments->results() as $comment) {
                        $name =  $comment->username;
                        $text .= $name . ": ". $comment->comment_text . "<br>";
                    }
                }
                echo "<div class = 'box column is-5 is-offset-one-quarter'>
                <img src='uploads/".$imageURL."'/>
                <br />
                <h4 class='subtitle is-5 has-text-right'><p style='color:#f35588'>$uploader $likes <a href='functions/add_like.php?image=".$imageURL."&user=".$name."'><img width=35 height=30 src='images/like_icon.png'/></a></p></h4>
                <h4 class='subtitle is-5 has-text-left'><a href='add_comment.php?image=".$imageURL."&user=".$name."'><img width=35 height=30 src='images/comment_icon.png'/></a></h4>
                <h4 class='subtitle is-7 has-text-left'><p>$text</p></h4>
                </div>";
                
            }
            
         } else{ 
            ?><p>No image(s) found...</p> <?php
         }
    }
}