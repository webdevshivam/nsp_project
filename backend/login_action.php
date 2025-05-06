<?php
session_start();
include 'includes/conn.php';


// Rate limiting using session (basic example)
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;
if ($_SESSION['login_attempts'] > 10) {
    die("Too many login attempts. Please try again later.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Clean and validate inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Exit if empty (extra layer even though 'required' is in HTML)
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username and password are required.'); window.history.back();</script>";
        exit();
    }

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Secure password check
        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true); // prevent session fixation

            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;

            // Reset login attempts
            $_SESSION['login_attempts'] = 0;

            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_attempts']++;
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
        }
    } else {
        $_SESSION['login_attempts']++;
        echo "<script>alert('No admin found with that username.'); window.history.back();</script>";
    }

    $stmt->close();
}
$conn->close();
