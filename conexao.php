<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "wmis8elnb8optsvw5cbi";
$dbName = "devaccess";
$password = "pscale_pw_Wpjvdp1btn49xnaPokMfCLPjTcCZFZqjyvPXeCsmWQn";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>