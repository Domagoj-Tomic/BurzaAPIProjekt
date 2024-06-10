<?php
class LatestDailyPage extends AbstractPage {
        public $templateName = 'latestDaily';

        public function __construct()
        {
                parent::__construct();
        }

        public function execute() {
                $sql = "SELECT * FROM LatestDaily";
                $result = AppCore::getDB()->sendQuery($sql);
                
                $this->data = $result;
        }

}