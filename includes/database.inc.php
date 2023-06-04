<?php

// Development Connection
// Server name or IP Address
$host = "localhost";

// MySQL Username
$user = "root";

// MySQL Password
$pass = "1q2w3e4r";

// Default Database name
$db = "myextradb";

// Creating a connection to the DataBase
$con = mysqli_connect($host, $user, $pass, $db);
$con->set_charset("utf8mb4");

/* Deployment Connection

$host = "SERVER_URL";
$user = "USERNAME";
$pass = "PASSWORD";
$db = "DATABASE_NAME";
$port = 'PORT_NO';

$con = mysqli_connect($host, $user, $pass, $db, $port);
*/

// Checking If the connection is obtained
if (!$con) {
  die("Database Connection Error");
}