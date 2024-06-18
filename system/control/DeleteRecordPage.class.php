<?php
class DeleteRecordPage extends AbstractPage
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
            return $this->data = "Invalid timeSeries";
        
        $info = "Failed to find stock info.";
        if(strlen($this->symbol) > 4) return $this->data = $info;
        $db = AppCore::getDB();

        if (empty($this->symbol)) {
            $result = $db->sendQuery("SHOW TABLES LIKE '%$this->timeSeries'");
            while ($row = $result->fetch_array()) {
                $db->sendQuery("DROP TABLE " . $row[0]);
            }
            $info = "Deletion of all tables in the $this->timeSeries time series complete.";
        } else {
            $fullTableName = $this->symbol . $this->timeSeries;
            $sql = "SHOW TABLES LIKE '$fullTableName'";
            if ($db->sendQuery($sql)->num_rows > 0) {
                $sql = "DROP TABLE $fullTableName";
                $db->sendQuery($sql);
                $info = "Deletion of $fullTableName complete.";
            }
        }

        $this->data = $info;
    }
}
