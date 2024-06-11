<?php
class IndexPage extends AbstractPage {
        public $templateName = 'index';

        public function __construct()
        {
                parent::__construct();
        }

        public function execute() {
                $resources = [
                        1 => [
                                "url" => "index.php",
                                "method" => "GET",
                                "description" => "Dokumentacija za API."
                        ],

                        2 => [
                                "url" => "index.php?page=LatestDaily",
                                "method" => "GET",
                                "description" => "Dohvati najnoviji low, high, close i open za sve praćene dionice."
                        ],

                        3 => [
                                "url" => "index.php?page=LatestDaily&symbol=IBM",
                                "method" => "GET",
                                "description" => "Dohvati najnoviji low, high, close i open za pojedinu dionicu. Obavezni parametri: symbol - ticker dionice čiju informaciju želite dohvatiti."
                        ],

                        4 => [
                                "url" => "index.php?page=AddStock&symbol=IBM",
                                "method" => "POST",
                                "description" => "Dodaj novu dionicu u bazu. Obavezni parametri: symbol - ticker dionice koju želite dodati u bazu."
                        ]
                ];
                
                $this->data = $resources;
        }

}
