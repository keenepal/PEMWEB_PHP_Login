<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user'; // default role, bisa disesuaikan

    // Cek apakah username sudah ada
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        // username sudah digunakan
        session_start();
        $_SESSION['error'] = "Username sudah terdaftar.";
        header("Location: register.php");
        exit;
    }

    // Cek apakah password dan konfirmasi cocok
    if ($password !== $confirm_password) {
        session_start();
        $_SESSION['error'] = "Password dan konfirmasi tidak cocok.";
        header("Location: register.php");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data user baru
    $sql_insert = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt_insert, "sss", $username, $hashed_password, $role);

    if (mysqli_stmt_execute($stmt_insert)) {
        // Register berhasil
        session_start();
        $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
        header("Location: login.php");
        exit;
    } else {
        // Register gagal karena error sistem
        session_start();
        $_SESSION['error'] = "Terjadi kesalahan. Silakan coba lagi.";
        header("Location: register.php");
        exit;
    }
}
?>
