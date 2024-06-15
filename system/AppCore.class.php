<?php
class AppCore
{
    protected static $dbObj = null;

    function __construct()
    {
        self::initDB();
        require_once(ROOT . "/system/util/RequestHandler.class.php");
        RequestHandler::handle();
    }

    function handleException(Exception $e)
    {
    }

    function initDB()
    {
        require_once(ROOT . "/system/config.inc.php");
        require_once(ROOT . "/system/model/MySQLiDatabase.class.php");
        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);
    }

    public static final function getDB()
    {
        return self::$dbObj;
    }
}
