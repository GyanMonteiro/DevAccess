<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "1cdoruxi6x68qjyhh49w";
$dbName = "devaccess";
$password = "pscale_pw_pgUQasWUn1JO3WFC5b5rYIRAHYpXOj5WBpnzQhvrZcA";


$mysqli = mysqli_init();

$mysqli->ssl_set(null, null, null, null, null);


$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>