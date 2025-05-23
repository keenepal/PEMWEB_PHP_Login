<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .profile-card h2 {
            color: #1976d2;
            margin-bottom: 10px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            border-radius: 50%;
            background: #bbdefb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #1976d2;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-info {
            text-align: left;
            margin-top: 20px;
        }

        .profile-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .back-btn {
            margin-top: 30px;
            display: inline-block;
            background-color: #2196f3;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .back-btn:hover {
            background-color: #1565c0;
        }
    </style>
</head>
<body>

<div class="profile-card">
    <div class="profile-image">
        <?= strtoupper(substr($username, 0, 1)) ?>
    </div>
    <h2>Profil Saya</h2>
    <div class="profile-info">
        <p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($role) ?></p>
        <!-- Tambahkan data lain jika ada -->
    </div>
    <a href="dashboard.php" class="back-btn">← Kembali ke Dashboard</a>
</div>

</body>
</html>