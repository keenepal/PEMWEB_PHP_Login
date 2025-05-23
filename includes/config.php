<?php
$host = "localhost";      // Host database (biasanya localhost)
$user = "root";           // Username database
$password = "";           // Password database
$database = "my_database"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>