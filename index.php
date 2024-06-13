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
    // Key za API: LILJ8YER1XKMEVE1
    /*
    Praćenje podataka, CRUD i JSON.
    Svi funkcionalni zahtjevi su gotovi! Yey!
    
    Na papiru još piše: 
    Sigurnost (SQL injection i XSS)
    Testiranje (Unit test i fake test)
    Dokumentacija (iako tu nema baš nešto ni za napravit)
    */
    ?>
</body>
</html>
