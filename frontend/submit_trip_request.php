<?php
include_once 'includes/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $pickup_location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
  $dropoff_location = mysqli_real_escape_string($conn, $_POST['dropoff_location']);
  $pickup_date = mysqli_real_escape_string($conn, $_POST['pickup_date']);
  $dropoff_date = mysqli_real_escape_string($conn, $_POST['dropoff_date']);
  $pickup_time = mysqli_real_escape_string($conn, $_POST['pickup_time']);

  $query = "INSERT INTO trip_requests (name, pickup_location, dropoff_location, pickup_date, dropoff_date, pickup_time)
              VALUES ('$name', '$pickup_location', '$dropoff_location', '$pickup_date', '$dropoff_date', '$pickup_time')";

  if (mysqli_query($conn, $query)) {
    header("Location: index.php?success=1");
    exit();
  } else {
    header("Location: index.php?error=1");
    exit();
  }
} else {
  header("Location: index.php");
  exit();
}
