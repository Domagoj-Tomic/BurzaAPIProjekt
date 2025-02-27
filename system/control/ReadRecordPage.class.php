<?php
class ReadRecordPage extends AbstractPage
{
    public $templateName = 'default';
    protected $symbol, $timeSeries;

    public function __construct()
    {
        $this->timeSeries = isset($_GET["timeSeries"]) ? $_GET["timeSeries"] : null;
        $this->symbol = isset($_GET["symbol"]) ? $_GET["symbol"] : null;
        switch ($this->timeSeries) {
            case 'daily':
            case 'weekly':
            case 'monthly':
                break;
            default:
                $this->timeSeries = null;
        }
        parent::__construct();
    }

    public function execute()
    {
        if($this->timeSeries === null)
                    return $this->data = json_encode((object) [ "Error" => "Invalid timeSeries" ]);
        
        $info = (object) [ "Error" => "Failed to find stock info" ];
        if(!preg_match('/^[A-Z0-9]{1,4}$/', $this->symbol)) return $this->data = json_encode($info);
        if ($this->symbol == null) {
            $sql = "SHOW TABLES LIKE '%$this->timeSeries'";
            $result = AppCore::getDB()->sendQuery($sql);
            $output = "[";
            while ($row = $result->fetch_assoc()) {
                $tableName = current($row);
                $queryResult = AppCore::getDB()->sendQuery("SELECT * FROM `$tableName` ORDER BY `Date` DESC LIMIT 1");
                $tableData = $queryResult->fetch_assoc();
                $formattedData = "{\"Stock\":\"" . $tableName . "\"";
                foreach ($tableData as $column => $value) {
                    $formattedData .= ",\"$column\":\"$value\"";
                }
                $output .= $formattedData . "},";
            }
            $this->data = rtrim($output, ",") . "]";
            return;
        }
        $fullTableName = $this->symbol . $this->timeSeries;
        $sql = "SHOW TABLES LIKE '$fullTableName'";
        if (AppCore::getDB()->sendQuery($sql)->num_rows > 0) {
            $sql = "SELECT * FROM $fullTableName";
            $result = AppCore::getDB()->sendQuery($sql);
            $info = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        $this->data = json_encode($info);
    }
}
