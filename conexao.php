<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "sf5mvmax7rjcx5it68k3";
$dbName = "devaccess";
$password = "pscale_pw_WYr7Nm7IpN64exT9yDLkctEq1TX2hEo1PzXuPgnJKC0";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>