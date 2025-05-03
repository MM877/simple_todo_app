<?php

class Database {

    private $DB_host = 'localhost';
    private $DB_USER = 'root';
    private $password = '';
    private $DB_name = 'todos';

    public $conn;

    public function connect() {
        $this->conn = null;

        try {
                $this->conn = new mysqli($this->DB_host, $this->DB_USER, $this->password, $this->DB_name);

                echo"connect";

           }
               catch (Exception) {
               echo "not connect with the database ";
         
               }

        return $this->conn;
    }
}





