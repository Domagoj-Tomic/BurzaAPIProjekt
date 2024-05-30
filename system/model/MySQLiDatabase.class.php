<?php
class MySQLiDatabase {
    public $MySQLi;
    protected $host;
    protected $user;
    protected $password;
    protected $database;

    public function __construct($hst, $usr, $pw, $db){
        $this->host = $hst;
        $this->user = $usr;
        $this->password = $pw;
        $this->database = $db;

        $this->connect();
    }

    protected function connect(){
        $this->MySQLi = new MySQLi($this->host, $this->user, $this->password, $this->database);
        if(mysql_connect_errno()) throw new DatabaseException("Lalalala");
    }

    protected function selectDatabase() {
        if($this->MySQLi->select_db($this->database) === false) throw new DatabaseException("Dumdumdumdum");
    }

    public function createDatbase() {
        try {
            $this->selectDatabase();
        } catch (DatabaseException $e) {
            try {
                $this->sendQuery("mmmmmm");
            } catch (DatabaseException $e2) {
                throw new DatabaseException("Tralala");
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