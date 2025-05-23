<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil dan validasi input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validasi password
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan konfirmasi password tidak sama";
        header("Location: ../register.php");
        exit();
    }

    // Cek username dengan prepared statement
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan, silakan pilih username lain";
        header("Location: ../register.php");
        exit();
    }
    $stmt->close();

    // Cek email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email sudah digunakan";
        header("Location: ../register.php");
        exit();
    }
    $stmt->close();

    // Default role
    $role = "user";

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: ../login.php?success=1");
        exit();
    } else {
        $_SESSION['error'] = "Registrasi gagal: " . $stmt->error;
        header("Location: ../register.php");
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../register.php");
    exit();
}
?>