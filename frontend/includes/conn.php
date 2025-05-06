<?php
$host = "localhost"; // or your host
$user = "root";      // your DB username
$pass = "";          // your DB password
$dbname = "nsp"; // replace with your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
