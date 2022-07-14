<?php
$servername = "31.22.4.112";
$username = "agnieves_admin";
$password = "Evien05131997";
$database = "agnieves_bkeeper";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>