<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "v0ifugsj67syy8l7y0i4";
$dbName = "devaccess";
$password = "pscale_pw_ubHuloC9KLUw9uYPcWmPy6TdDUJfCkEcyOEW2vRRlrG";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>