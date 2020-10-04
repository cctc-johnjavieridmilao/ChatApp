<?php

class Connection {

	private $host = 'localhost';
	private $username = 'root';
	private $password = 'Jhayjhay12345!';
	private $db_name = 'chat_system';
	private $conn;
   
    public function __construct() {}

    protected function DBConnect() {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}