<?php
class DeleteRecordPage extends AbstractPage {
    public $templateName = 'default';
    protected $symbol, $timeSeries;

    public function __construct()
    {
        $this->timeSeries = isset($_GET["timeSeries"]) ? $_GET["timeSeries"] : null;
        $this->symbol = isset($_GET["symbol"]) ? $_GET["symbol"] : null;
        parent::__construct();
    }

    public function execute() {
        $info = "Failed to find stock info.";
        $fullTableName = $this->symbol . $this->timeSeries;
        $sql = "SHOW TABLES LIKE '$fullTableName'";
        if(AppCore::getDB()->sendQuery($sql)->num_rows > 0){
            $sql = "DROP TABLE $fullTableName";
            AppCore::getDB()->sendQuery($sql);
            $info = "Deletion of $fullTableName complete.";
        }
        $this->data = json_encode($info);
    }
}