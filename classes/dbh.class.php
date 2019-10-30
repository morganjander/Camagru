<?php

class Dbh {

    private static $_instance = null;
    private $_pdo,          //stores pdo instance
            $_query,        //  last query executed
            $_error = false, // whether the query failed or not
            $_results,      // result set
            $_count = 0; // count of results

    private function __construct(){ 
        try {
            $dsn ="mysql:host=". config::get('mysql/host') . ";dbname=" . config::get('mysql/dbname') . ";charset=" . config::get('mysql/charset'); //Data/base Source Name
            $this->_pdo = new PDO($dsn, config::get('mysql/username'), config::get('mysql/password')); //establishes a new connection and stores created PDO instance
            

        } catch (PDOException $e){ //catches the exception thrown by the PDO constructor
            echo "Connection failed: ". $e->getMessage();
        }      
    }

    public static function getInstance(){
        if(!isset(self::$_instance)) {//only create connection once
            self::$_instance = new Dbh();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ); //stores an object in $_results, not an array
                $this->_count = $this->_query->rowCount();
            }
            else {
                $this->_error = true;
            }
        }
        return $this;

    }

    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {//need field, operator, value
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;       
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    public function count(){
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }
}