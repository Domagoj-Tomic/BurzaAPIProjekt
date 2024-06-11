<?php
class LatestDailyPage extends AbstractPage {
        public $templateName = 'latestDaily';

        public function __construct()
        {
                parent::__construct();
        }

        public function execute() {
                $sql = "SELECT * FROM stockInfo.LatestDaily";
                $result = AppCore::getDB()->sendQuery($sql);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                $this->data = json_encode($rows);
        }

}