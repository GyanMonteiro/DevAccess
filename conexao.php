<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "ls8zcbvq3ck3pt73vody";
$dbName = "devaccess";
$password = "pscale_pw_on33V56iQZxkKywHacveHsx4Drfs32A7n2QA23To4Fl";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>