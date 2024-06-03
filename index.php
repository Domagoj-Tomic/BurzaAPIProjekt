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
    echo "Ako vidiš ovo, index.php je ok.<br>";
    echo "Ako si gore vidio tri stavke i nijedan error, sve je ok (valjda).";
    ?>
</body>
</html>