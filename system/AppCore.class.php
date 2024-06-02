<?php
class AppCore {
    function __construct()
    {
        require_once(ROOT . "\\system\\util\\RequestHandler.class.php");
        $requestHandler = new RequestHandler("Index");
    }

    function handleException(Exception $e) {

    }

    function initDB(){

    }

    function getDB(){

    }
}