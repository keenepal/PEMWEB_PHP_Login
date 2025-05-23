<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$isAdmin = $role === 'admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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

        .dashboard-card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 450px;
            width: 100%;
            text-align: center;
        }

        .dashboard-card h2 {
            color: #1976d2;
            margin-bottom: 20px;
        }

        .welcome-message {
            margin-bottom: 20px;
        }

        .panel {
            background-color: #f1f9ff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .panel h3 {
            color: #1976d2;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            margin: 6px;
            padding: 10px 16px;
            background-color: #2196f3;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #1565c0;
        }

        .logout-btn {
            background-color: #f44336;
        }

        .logout-btn:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

<div class="dashboard-card">
    <h2>Selamat Datang</h2>
    <div class="welcome-message">
        <p>Halo, <strong><?= htmlspecialchars($username) ?></strong></p>
        <p>Role: <?= htmlspecialchars($role) ?></p>
        <p>Anda telah berhasil login ke sistem.</p>
    </div>

    <?php if ($isAdmin): ?>
        <div class="panel">
            <h3>Admin Panel</h3>
            <a href="#" class="btn">Kelola User</a>
            <a href="#" class="btn">Lihat Log</a>
            <a href="#" class="btn">Pengaturan</a>
        </div>
    <?php else: ?>
        <div class="panel">
            <h3>Menu User</h3>
            <a href="profile.php" class="btn">Profil Saya</a>
            <a href="#" class="btn">Ubah Password</a>
        </div>
    <?php endif; ?>

    <a href="logout.php" class="btn logout-btn">Logout</a>
</div>

</body>
</html>