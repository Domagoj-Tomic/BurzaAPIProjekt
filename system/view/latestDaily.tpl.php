<?php
while($row = AppCore::getDB()->fetchArray($data)){
        printf($row['Symbol'].", ".$row['LastRefreshed'].", ".$row['TimeZone'].", ".$row['open'].", ".$row['high'].", ".$row['low'].", ".$row['close'].", ".$row['volume']);
        echo "<br>";
}
?>