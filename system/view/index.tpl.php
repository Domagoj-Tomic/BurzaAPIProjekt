Burza API ©2024 Bogdan Grabovac i Domagoj Tomić<br><br>

<?php
foreach($resources as $key => $data) {
        echo "<strong>";
        echo $key;
        echo $data["url"];
        echo "</strong>";
        echo "<br>";
        echo "Metoda: " . $data["method"];
        echo "<br>";
        echo $data["description"];
        echo "<br>";
}