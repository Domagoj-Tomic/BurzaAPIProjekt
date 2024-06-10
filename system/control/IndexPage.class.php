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
                                "url" => "Index - index.php",
                                "method" => "GET",
                                "description" => "Dokumentacija za API."
                        ],

                        2 => [
                                "url" => "Latest Daily - index.php?page=LatestDaily",
                                "method" => "GET",
                                "description" => "Dohvati naj noviji low high close open za praćene dionice."
                        ],

                        3 => [
                                "url" => "AddStock - index.php?page=AddStock&symbol=addSymbol",
                                "method" => "POST",
                                "description" => "Dodaj novu dionicu u bazu. Obavezni parametri: addSymbol - ticker dionice koju želite dodati u bazu."
                        ]
                ];
                
                $this->data = $resources;
        }

}
