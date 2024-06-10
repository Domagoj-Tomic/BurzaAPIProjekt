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
        //Ovo će kreirati novu bazu i tablicu ako već ne postoji, poboljšana je prenosivost softvera
        $this->sendQuery("CREATE DATABASE IF NOT EXISTS " . $this->database);
        $this->mysqli->connect($this->host, $this->user, $this->password, $this->database);
        //Pojedina dionica može imati samo jedan zapis, a svaka dionica ima jedinstveni ticker simbol,
        //stoga Ticker simbol bez problema može biti ključ.
        $this->sendQuery(
            "CREATE TABLE IF NOT EXISTS `LatestDaily` (
            `Symbol` varchar(10) NOT NULL,
            `LastRefreshed` date NOT NULL,
            `TimeZone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `open` float NOT NULL,
            `high` float NOT NULL,
            `low` float NOT NULL,
            `close` float NOT NULL,
            `volume` bigint NOT NULL,
            PRIMARY KEY (Symbol)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
        );
    }

    public function sendQuery($query) {
        return $this->mysqli->query($query);
    }

    public function fetchArray($result = null) {
        return $result->fetch_array(MYSQLI_BOTH);
    }
}
?>