<?php
class MySQLiDatabase {
    public $MySQLi;
    protected $host, $user, $password, $database;
    protected $queryCount, $result; 

    public function __construct($hst, $usr, $pw, $db){
        $this->host = $hst;
        $this->user = $usr;
        $this->password = $pw;
        $this->database = $db;

        $this->connect();
    }

    protected function connect(){
        $this->MySQLi = new MySQLi($this->host, $this->user, $this->password, $this->database);
        if(mysqli_connect_errno()) throw new DatabaseException("Error connecting to database");
    }

    protected function selectDatabase() {
        if($this->MySQLi->select_db($this->database) === false) throw new DatabaseException("Error selecting database");
    }

    public function createDatbase() {
        try {
            $this->selectDatabase();
        } catch (DatabaseException $e) {
            try {
                $this->sendQuery("mmmmmm");
            } catch (DatabaseException $e2) {
                throw new DatabaseException("Error creating database");
            }
        }
    }

    public function sendQuery($query, $errorReporting = true) {
        $this->queryCount++;
        $this->result = $this->MySQLi->query($query);
        if($this->result === false && $errorReporting === true) throw new DatabaseException("Bumbumbum");
        return $this->result;
    }
}
?>