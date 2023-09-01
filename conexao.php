<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "qqst4xzv0y3tq3abo8g8";
$dbName = "devaccess";
$password = "pscale_pw_q4z86HGmeqmtdkR8S4NcOuu73NLgHX2LmUsGTMZ1mV0";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>