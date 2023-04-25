<?php
$servername = "161.246.18.205";
$username = "TTS";
$password = "ttsproj";
$dbname = "JAMMING";
$port = 3306;

$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "";
?>