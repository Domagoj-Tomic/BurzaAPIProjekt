<?php
class IndexPage extends AbstractPage {
        public $templateName = 'index';

        public function __construct()
        {
                // Poziv AbstractPage konstruktora.
                parent::__construct();
        }

        public function execute() {
                $resources = [
                        1 => [
                                "url" => "Index",
                                "method" => "GET",
                                "description" => "Dokumentacija za API."
                        ],

                        2 => [
                                "url" => "GetData",
                                "method" => "GET",
                                "description" => "Dohvati podatke iz baze. Podržani parametri: blabla" //TODO: popuniti opis parametrima
                        ],

                        3 => [
                                "url" => "AddStock",
                                "method" => "POST",
                                "description" => "Dodaj novu dionicu u bazu. Obavezni parametri: blabla" //TODO: popuniti opis parametrima
                        ]
                ];
                
                $this->data = $resources;
        }

}
