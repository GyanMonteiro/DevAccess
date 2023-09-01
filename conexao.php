<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "xfhnxsltkbu8bxk4bhr0";
$dbName = "devaccess";
$password = "pscale_pw_OmSDt2hDWBn0Hr2VGk6GII9AxD57j4z0Ztw1XTf6N0F";

// Set SSL cert and open connection to the MySQL server
$mysqli = mysqli_init();

// Enable SSL
$mysqli->ssl_set(null, null, null, null, null);

// Open connection with SSL
$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>