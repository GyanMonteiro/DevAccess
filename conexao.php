<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "ac38diqqf3erhh4lm1kz";
$dbName = "devaccess";
$password = "pscale_pw_HnmIJqzRgCHABOhFFMb64iJ921tLMXp4jm4gCmkgPig";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>