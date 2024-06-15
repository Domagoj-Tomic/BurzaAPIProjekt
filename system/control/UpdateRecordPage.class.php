<?php
class UpdateRecordPage extends AbstractPage
{
    public $templateName = 'default';
    protected $function, $symbol, $apiKey, $tsLabel, $timeSeries;

    public function __construct()
    {
        $this->apiKey = "demo";
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
        }
        parent::__construct();
    }

    public function execute()
    {
        $result = json_decode(file_get_contents('https://www.alphavantage.co/query?function=' . $this->function . '&symbol=' . $this->symbol . '&apikey=' . $this->apiKey), true);

        if (isset($result['Information'])) {
            echo 'API returned an error: ' . $result['Information'] . '<br>';
            echo 'Demo key prihvaća samo "IBM" kao simbol.<br><br><br>';
        }

        $tableName = $result["Meta Data"]["2. Symbol"];
        $timeseries = $result[$this->tsLabel];
        $this->data = $this->createTableAndInsertData($tableName, $timeseries);
    }

    private function createTableAndInsertData($tableName, $timeseries, $percentageIncrease = 1)
    {
        $fullTableName = $tableName . $this->timeSeries;
        $sql = "SHOW TABLES LIKE '$fullTableName'";
        if (AppCore::getDB()->sendQuery($sql)->num_rows < 1) return "Table for $tableName has not yet been added to tracked stocks in this time series.";

        foreach ($timeseries as $date => $data) {
            $open = $data["1. open"] * $percentageIncrease;
            $high = $data["2. high"] * $percentageIncrease;
            $low = $data["3. low"] * $percentageIncrease;
            $close = $data["4. close"] * $percentageIncrease;
            $volume = $data["5. volume"] * $percentageIncrease;
            $sql = "INSERT IGNORE INTO $fullTableName (Date, Open, High, Low, Close, Volume)
                        VALUES ('$date', '$open', '$high', '$low', '$close', '$volume')";

            AppCore::getDB()->sendQuery($sql);
        }
        return "Table for $tableName has been updated.";
    }
}
