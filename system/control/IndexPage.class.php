<?php
class IndexPage extends AbstractPage
{
        public $templateName = 'index';

        public function __construct()
        {
                parent::__construct();
        }

        public function execute()
        {
                $resources = [
                        1 => [
                                "url" => "index.php",
                                "method" => "GET",
                                "description" => "Documentation for the API.",
                                "parameters" => []
                        ],

                        2 => [
                                "url" => "index.php?page=CreateRecord&symbol=IBM&timeSeries=daily&adminKey=admin",
                                "method" => "POST",
                                "description" => "Creates historical data for a stock of your choosing.",
                                "parameters" => [
                                        "symbol" => "Required: The name of the equity of your choice. For example: symbol=IBM",
                                        "timeSeries" => "Required: The selected time frame for historical data. Accepts three different inputs: daily, weekly and monthly. For example: timeSeries=daily",
                                        "adminKey" => "Required: This function is only available to authorised users with an adminKey. For example: adminKey=admin"
                                ]
                        ],

                        3 => [
                                "url" => "index.php?page=ReadRecord&symbol=IBM&timeSeries=daily",
                                "method" => "GET",
                                "description" => "Returns tracked historical data for a stock of your choosing.",
                                "parameters" => [
                                        "symbol" => "The name of the equity of your choice. Leave out the symbol in order to generate the latest data of every stock in the time series. For example: symbol=IBM",
                                        "timeSeries" => "Required: The selected time frame for historical data. Accepts three different inputs: daily, weekly and monthly. For example: timeSeries=daily"
                                ]
                        ],

                        4 => [
                                "url" => "index.php?page=UpdateRecord&symbol=IBM&timeSeries=daily&adminKey=admin",
                                "method" => "PUT",
                                "description" => "Updates tracked historical data for a stock of your choosing.",
                                "parameters" => [
                                        "symbol" => "Required: The name of the equity of your choice. For example: symbol=IBM",
                                        "timeSeries" => "Required: The selected time frame for historical data. Accepts three different inputs: daily, weekly and monthly. For example: timeSeries=daily",
                                        "adminKey" => "Required: This function is only available to authorised users with an adminKey. For example: adminKey=admin"
                                ]
                        ],

                        5 => [
                                "url" => "index.php?page=DeleteRecord&symbol=IBM&timeSeries=daily&adminKey=admin",
                                "method" => "DELETE",
                                "description" => "Deletes tracked historical data for a stock of your choosing.",
                                "parameters" => [
                                        "symbol" => "The name of the equity of your choice. If empty, the database is wiped for the selected timeSeries. For example: symbol=IBM",
                                        "timeSeries" => "Required: The selected time frame for historical data. Accepts three different inputs: daily, weekly and monthly. For example: timeSeries=daily",
                                        "adminKey" => "Required: This function is only available to authorised users with an adminKey. For example: adminKey=admin"
                                ]
                        ]
                ];

                $this->data = $resources;
        }
}
