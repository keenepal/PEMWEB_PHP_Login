<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validasi & escape input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password (plaintext sesuai database)
        if ($password === $user['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Password yang Anda masukkan salah";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan";
        header("Location: ../login.php");
        exit();
    }

    $stmt->close();
} else {
    header("Location: ../login.php");
    exit();
}
?>