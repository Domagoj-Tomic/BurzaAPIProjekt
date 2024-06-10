<?php
class AddStockPage extends AbstractPage {
        public $templateName = 'addStock';
        protected $symbol;

        public function __construct()
        {
                $this->symbol = $_GET["symbol"];
                parent::__construct();
        }

        public function execute() {
                $json = json_decode(file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=demo'), true);
                // Kod ispod je za pravi API, ali aphavantage ima limit od 25 api call-ova po danu pa koristim demo key za testiranje
                // $json = json_decode(file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol='.$this->symbol.'&apikey=LILJ8YER1XKMEVE1'), true);
                $meta = $json["Meta Data"];
                $value = array_shift($json["Time Series (Daily)"]);
                //Unesi novi zapis ako već ne postoji isti ključ. Ako postoji, ažuriraj postojeći zapis.
                $sql = "
                INSERT INTO LatestDaily (Symbol, LastRefreshed, TimeZone, open, high, low, close, volume)
                VALUES ('".$meta["2. Symbol"]."','".$meta["3. Last Refreshed"]."','".$meta["5. Time Zone"]."','".$value["1. open"].
                "','".$value["2. high"]."','".$value["3. low"]."','".$value["4. close"]."','".$value["5. volume"]."')
                ON DUPLICATE KEY UPDATE 
                LastRefreshed = VALUES(LastRefreshed), 
                TimeZone = VALUES(TimeZone), 
                open = VALUES(open), 
                high = VALUES(high), 
                low = VALUES(low), 
                close = VALUES(close), 
                volume = VALUES(volume);";
                AppCore::getDB()->sendQuery($sql);
                
                $this->data = $json;

                //Ovo slobodno možeš izbrisati, query je integriran u kod.
                /* SQL za LatestDaily tablicu 
                CREATE TABLE `LatestDaily` (
                `ID` int NOT NULL,
                `Symbol` varchar(10) NOT NULL,
                `LastRefreshed` date NOT NULL,
                `TimeZone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                `open` float NOT NULL,
                `high` float NOT NULL,
                `low` float NOT NULL,
                `close` float NOT NULL,
                `volume` bigint NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

                ALTER TABLE `LatestDaily`
                ADD PRIMARY KEY (`ID`);

                ALTER TABLE `LatestDaily`
                MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
                COMMIT;
                */
        }

}
