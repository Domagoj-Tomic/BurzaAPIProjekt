<?php
class RequestHandler {
        //ovo sve je kopirano nepromjenjeno iz vježbe 6
        function __construct($className)
        {
                $className = $className . "Page";
                require_once(ROOT . "/system/control/" . $className . ".class.php");
                new $className();
                echo "Ako vidiš ovo, RequestHandler.class.php je ok.<br>";
        }

        public static function handle(){
                $request = $_GET["page"] ?? "Index";
                new RequestHandler($request);
        }
}