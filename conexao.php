<?php 
$hostname = "aws.connect.psdb.cloud";
$username = "11fsbrbvsc0gug8zk3ln";
$dbName = "devaccess";
$password = "pscale_pw_V5wJUNaOPmYmXWtNIvKXnfP0GkefrInzGOfDcRJ69c";


$mysqli = mysqli_init();

$mysqli->ssl_set(null, null, null, null, null);


$mysqli->real_connect($hostname, $username, $password, $dbName, 3306, null, MYSQLI_CLIENT_SSL);
?>