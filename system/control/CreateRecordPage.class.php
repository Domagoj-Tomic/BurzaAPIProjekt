<?php
class CreateRecordPage extends AbstractPage
{
        public $db, $templateName = 'default';
        protected $function, $symbol, $apiKey, $tsLabel, $timeSeries;

        public function __construct()
        {
                $this->apiKey = "demo";
                $this->db = AppCore::getDB();
                $this->symbol = isset($_GET["symbol"]) ? $_GET["symbol"] : null;
                $this->timeSeries = isset($_GET["timeSeries"]) ? $_GET["timeSeries"] : null;
                switch ($this->timeSeries) {
                        case 'daily':
                                $this->function = "TIME_SERIES_DAILY";
                                $this->tsLabel = "Time Series (Daily)";
                                break;
                        case 'weekly':
                                $this->function = "TIME_SERIES_WEEKLY";
                                $this->tsLabel = "Weekly Time Series";
                                break;
                        case 'monthly':
                                $this->function = "TIME_SERIES_MONTHLY";
                                $this->tsLabel = "Monthly Time Series";
                                break;
                        default:
                                $this->timeSeries = null;
                }
                parent::__construct();
        }

        public function execute()
        {
                if($this->timeSeries === null)
                        return $this->data = "Invalid timeSeries";

                $result = json_decode(file_get_contents('https://www.alphavantage.co/query?function=' . $this->function . '&symbol=' . $this->symbol . '&apikey=' . $this->apiKey), true);

                if(isset($result['Error Message']))
                        return $this->data = "Invalid symbol";

                if (isset($result['Information'])) {
                        echo 'API returned an error: ' . $result['Information'] . '<br>';
                        echo 'Demo key prihvaća samo "IBM" kao simbol.<br><br><br>';
                }

                $tableName = $result["Meta Data"]["2. Symbol"];
                $timeseries = $result[$this->tsLabel];
                $this->data = $this->createTableAndInsertData($tableName, $timeseries);
                if ($this->data != "Table for $tableName already exists.")
                        if ($this->apiKey === "demo") {
                                $percentageIncrease = 1.1;
                                for ($i = 0; $i < 4; $i++) {
                                        $fakeSymbol = $this->generateRandomString();
                                        $this->createTableAndInsertData($fakeSymbol, $timeseries, $percentageIncrease);
                                        $percentageIncrease *= 1.1;
                                }
                        }
        }

        public function createTableAndInsertData($tableName, $timeseries, $percentageIncrease = 1)
        {
                $fullTableName = $tableName . $this->timeSeries;
                $sql = "SHOW TABLES LIKE '$fullTableName'";
                if ($this->db->sendQuery($sql)->num_rows > 0) return "Table for $tableName already exists.";
                $sql = "CREATE TABLE IF NOT EXISTS $fullTableName (
                `Date` date NOT NULL,
                `Open` decimal(10,2) NOT NULL,
                `High` decimal(10,2) NOT NULL,
                `Low` decimal(10,2) NOT NULL,
                `Close` decimal(10,2) NOT NULL,
                `Volume` bigint(20) NOT NULL,
                PRIMARY KEY (`Date`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

                $this->db->sendQuery($sql);

                foreach ($timeseries as $date => $data) {
                        $open = $data["1. open"] * $percentageIncrease;
                        $high = $data["2. high"] * $percentageIncrease;
                        $low = $data["3. low"] * $percentageIncrease;
                        $close = $data["4. close"] * $percentageIncrease;
                        $volume = $data["5. volume"] * $percentageIncrease;
                        $sql = "INSERT IGNORE INTO $fullTableName (Date, Open, High, Low, Close, Volume)
                                VALUES ('$date', '$open', '$high', '$low', '$close', '$volume')";

                        $this->db->sendQuery($sql);
                }
                return "Table for $tableName created.";
        }

        public function generateRandomString()
        {
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
