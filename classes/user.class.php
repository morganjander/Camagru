<?php

class User extends Dbh {

    public function getAllUsers(){

        $stmt = $this->connect()->query("SELECT * FROM users");
        while ($row = $stmt->fetch()) {
            echo $row['name'];
        }
    }
}