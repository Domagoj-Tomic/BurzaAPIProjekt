<?php
class RequestHandler {
        function __construct($className)
        {
                $className = $className . "Page";
                // Include-anje AbstractPage-a
                require_once(ROOT . '/system/control/AbstractPage.class.php');
                require_once(ROOT . "/system/control/" . $className . ".class.php");
                new $className();
        }

        public static function handle(){
                $request = $_GET["page"] ?? "Index";
                new RequestHandler($request);
        }
}
