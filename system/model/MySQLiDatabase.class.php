<?php
class MySQLiDatabase {
    public $MySQLi;
    protected $host, $user, $password, $database;

    public function __construct($hst, $usr, $pw, $db){
        $this->host = $hst;
        $this->user = $usr;
        $this->password = $pw;
        $this->database = $db;

        $this->connect();
    }

    protected function connect(){
        $this->MySQLi = new MySQLi($this->host, $this->user, $this->password, $this->database);
    }

// Izbrisao sam select i create database pošto ionako koristimo samo jedan db iz config.inc.php

    public function sendQuery($query) {
        return $this->MySQLi->query($query);
    }

    public function fetchArray($result = null) {
        return $result->fetch_array(MYSQLI_BOTH);
    }
}
?>