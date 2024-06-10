<?php
//header('Content-type: Application/JSON');
echo "New stock data added.";
echo "<pre>";
echo json_encode(($data["Meta Data"]), JSON_PRETTY_PRINT) ."<br>". json_encode(array_shift($data["Time Series (Daily)"]), JSON_PRETTY_PRINT);
echo "</pre>"
?>