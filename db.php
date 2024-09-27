<?php
$host = "61.245.248.171";
$user = "root";
$pw = "moon";
$db = "test";
$dbconnect = mysqli_connect($host,$user,$pw,$db,3307);

if (!$dbconnect) {
    echo("Connection failed: ");
}

echo "ip:",$host,"</br>";
echo "user:",$user,"</br>";
echo "반갑노";

?>


