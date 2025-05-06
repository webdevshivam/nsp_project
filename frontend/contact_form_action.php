<?php
include_once 'includes/conn.php'; // database connection

if (isset($_POST['submit'])) {
  $name    = mysqli_real_escape_string($conn, $_POST['name']);
  $email   = mysqli_real_escape_string($conn, $_POST['email']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $message = mysqli_real_escape_string($conn, $_POST['message']);

  $query = "INSERT INTO contacts (name, email, subject, message)
              VALUES ('$name', '$email', '$subject', '$message')";

  if (mysqli_query($conn, $query)) {
    // Redirect to contact page with success message
    header("Location: contact.php?success=1");
    exit();
  } else {
    // Error
    echo "Error: " . mysqli_error($conn);
  }
} else {
  header("Location: contact.php"); // if someone directly opens this page
  exit();
}
