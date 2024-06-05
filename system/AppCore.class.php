<?php
class AppCore {
protected static $dbObj = null;

    function __construct()
    {
        require_once(ROOT . "/system/util/RequestHandler.class.php");
        // handle je static pa ga ne moramo instancirati
        RequestHandler::handle();

        // računam da je bolje da includamo model odmah po pokretanju
        // skoro sve metode su javne, pa nije nemoguće da se pozovu van reda
        // bolja praksa bi bila propisna kontrola pristupa, ali eto ¯\_(ツ)_/¯
        require_once(ROOT . "/system/model/MySQLiDatabase.class.php");
    }

    function handleException(Exception $e) {

    }

    function initDB(){
        $dbHost = $dbUser = $dbPassword = $dbName = $dbCharset = "";
        require_once(ROOT . "/system/config.inc.php"); //dohvat postavki

        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);
    }

    function getDB(){

    }
}
