<?php
class AppCore {
    function __construct()
    {
        require_once(ROOT . "/system/util/RequestHandler.class.php");
        // handle je static pa ga ne moramo instancirati
        RequestHandler::handle();
    }

    function handleException(Exception $e) {

    }

    function initDB(){

    }

    function getDB(){

    }
}
