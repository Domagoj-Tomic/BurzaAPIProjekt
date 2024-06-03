<?php
define("ROOT", str_replace("\\", "/", __DIR__));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    require_once(ROOT . '/system/AppCore.class.php');
    $appCore = new AppCore();
    // https://www.alphavantage.co/documentation/
    // Key za API: LILJ8YER1XKMEVE1
    // URL path absolutan kao u vjezbi
    // Fetch-at podatke dionica: dnevno i povijesni za preddefinirane dionice
    // CRUD za administraciju dionica
    // Ispis u JSON formatu
    // Siguran od SQL injekcija i XSS-a
    // Jedan unit test
    // Jedan fake test
    // Dokumentacija
    ?>
</body>
</html>
