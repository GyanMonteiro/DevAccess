<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "zr524b6bgvxu5esfokwx";
$dbName = "devaccess";
$password = "pscale_pw_ud1nfxINbmIwiS9wzQRebSYGvQvmkBjrFc2gRpwJqoc";


$mysqli = mysqli_init();

$mysqli->ssl_set(null, null, null, null, null);


$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>