<?php
class MySQLiDatabase {
    public $mysqli;
    protected $host, $user, $password, $database;

    public function __construct($hst, $usr, $pw, $db){
        $this->host = $hst;
        $this->user = $usr;
        $this->password = $pw;
        $this->database = $db;

        $this->connect();
    }

    protected function connect(){
        $this->mysqli = new MySQLi($this->host, $this->user, $this->password);
        $this->sendQuery("CREATE DATABASE IF NOT EXISTS " . $this->database);
        $this->mysqli->connect($this->host, $this->user, $this->password, $this->database);
    }

    public function sendQuery($query) {
        return $this->mysqli->query($query);
    }
}