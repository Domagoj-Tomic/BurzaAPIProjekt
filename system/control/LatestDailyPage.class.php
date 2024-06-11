<?php
class LatestDailyPage extends AbstractPage {
        public $templateName = 'latestDaily';
        protected $symbol;

        public function __construct()
        {
                $this->symbol = isset($_GET["symbol"]) ? $_GET["symbol"] : null;
                parent::__construct();

                //var_dump($this->symbol);
        }

        public function execute() {
                $db = AppCore::getDB();

                if ($this->symbol !== null) {
                        $tableName = $this->symbol;
                        $result = $db->sendQuery("SHOW TABLES LIKE '$tableName'");
                        if ($result->num_rows > 0) {
                                $queryResult = $db->sendQuery("SELECT * FROM `$tableName` ORDER BY `Date` DESC LIMIT 1");
                                $row = $queryResult->fetch_assoc();
                                $this->data = "<strong>Stock: $tableName<br></strong>";
                        foreach ($row as $column => $value) {
                                $this->data .= "$column: $value<br>";
                        }
                        } else {
                                $this->data = "Error: No stock found with the name '" . strtoupper($tableName) . "'";
                        }
                } else {
                        $result = $db->sendQuery("SHOW TABLES");
                        $output = "";
                        while ($row = $result->fetch_assoc()) {
                                $tableName = current($row);
                                $queryResult = $db->sendQuery("SELECT * FROM `$tableName` ORDER BY `Date` DESC LIMIT 1");
                                $tableData = $queryResult->fetch_assoc();
                                $formattedData = "<strong>Stock: " . strtoupper($tableName) . "<br></strong>";
                        foreach ($tableData as $column => $value) {
                                $formattedData .= "$column: $value<br>";
                        }
                        $output .= $formattedData . "<br>";
                        }
                        $this->data = $output;
                }
        }
}