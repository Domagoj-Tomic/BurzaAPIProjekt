<?php
class IndexPage {
        //kopirano iz vježbe 6, sa malim izmjenama
        //dovršiti kasnije
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
                                "desctiption" => "Dohvati podatke iz baze. Podržani parametri: blabla" //TODO: popuniti opis parametrima
                        ],

                        3 => [
                                "url" => "AddStock",
                                "method" => "POST",
                                "description" => "Dodaj novu dionicu u bazu. Obavezni parametri: blabla" //TODO: popuniti opis parametrima
                        ]
                ];
        }
}