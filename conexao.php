<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "0uvqwixtkt9z64elqvwj";
$dbName = "devaccess";
$password = "pscale_pw_7TTcJuzR8cZLN71TN1brrmIR8rzeYWMPMnDDf1lq7vQ";


$mysqli = mysqli_init();

$mysqli->ssl_set(null, null, null, null, null);


$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>