<?php
class AddStockPage extends AbstractPage {
        public $templateName = 'addStock';
        protected $symbol;
        protected $apiKey = "demo";
        //protected $apiKey = LILJ8YER1XKMEVE1;

        public function __construct()
        {
                $this->symbol = $_GET["symbol"];
                parent::__construct();
        }

        public function execute() {
                $json = json_decode(file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='.$this->symbol.'&apikey=' . $this->apiKey), true);
        
                if (isset($json['Information'])) {
                        echo 'API returned an error: ' . $json['Information'] . '<br>';
                        echo 'Demo key prihvaća samo "IBM" kao simbol.<br><br><br>';
                }

                $meta = $json["Meta Data"];
                $timeseries = $json["Time Series (Daily)"];

                // Kreiraj tablicu za dionicu
                $tableName = $meta["2. Symbol"];
                $this->createTableAndInsertData($tableName, $timeseries);

                // Napravi 19 dodatnih dionica ako se koristi demo key
                if ($this->apiKey === "demo") {
                        $percentageIncrease = 1.1;
                        for ($i = 0; $i < 19; $i++) {
                                $fakeSymbol = $this->generateRandomString();
                                $this->createTableAndInsertData($fakeSymbol, $timeseries, $percentageIncrease);
                                $percentageIncrease *= 1.1;
                        }
        }

        $this->data = $json;
        }

        private function createTableAndInsertData($tableName, $timeseries, $percentageIncrease = 1) {
                $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
                `Date` date NOT NULL,
                `Open` decimal(10,2) NOT NULL,
                `High` decimal(10,2) NOT NULL,
                `Low` decimal(10,2) NOT NULL,
                `Close` decimal(10,2) NOT NULL,
                `Volume` bigint(20) NOT NULL,
                PRIMARY KEY (`Date`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

                AppCore::getDB()->sendQuery($sql);

                // Unesi povjesne podatke u tablicu
                foreach ($timeseries as $date => $data) {
                        $open = $data["1. open"] * $percentageIncrease;
                        $high = $data["2. high"] * $percentageIncrease;
                        $low = $data["3. low"] * $percentageIncrease;
                        $close = $data["4. close"] * $percentageIncrease;
                        $volume = $data["5. volume"] * $percentageIncrease;
                        $sql = "INSERT IGNORE INTO `$tableName` (Date, Open, High, Low, Close, Volume)
                                VALUES ('$date', '$open', '$high', '$low', '$close', '$volume')";

                        AppCore::getDB()->sendQuery($sql);
                }
        }

        private function generateRandomString() {
                $length = rand(3, 4);
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
        }

}
