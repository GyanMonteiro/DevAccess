<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "6vqo3ph1ufasbnxt6wuy";
$dbName = "devaccess";
$password = "pscale_pw_CJtJnpVL9CXhWC88561fvHrpRtvozisxSCgL19Io7Oo";


$mysqli = mysqli_init();

$mysqli->ssl_set(null, null, null, null, null);


$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>