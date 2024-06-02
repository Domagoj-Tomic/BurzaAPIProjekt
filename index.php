<?php
//Konstanta koja sadržava root directory (lokaciju index.php datoteke)
//Koristimo ju u svim drugim datotekama kad pozivamo require_once() ili slično
define("ROOT", __DIR__);
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
    require_once(ROOT . '\\system\\AppCore.class.php');
    //Pošto Windows koristi backslash, a ne forward slash u svom file sistemu,
    //trebamo escape-ati backslashove sa još jednim backslashom.
    //Hvala, Bill Gates.
    //Upravo mi je palo na pamet da si ti na Ubuntu, stoga ne znam kako će to
    //uopće funkcionirati kod tebe
    //Želim umrijeti :D
    $appCore = new AppCore();
    ?>
</body>
</html>