<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';

// pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit;
}

// ambil data user dari DB
$stmt = $koneksi->prepare("
    SELECT nama_lengkap, username, email, nik, status
    FROM users
    WHERE user_id = ?
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .profile-card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 20px;
            color: #333;
            text-decoration: none;
        }

        .back-btn:hover {
            color: #007bff;
        }

        .profile-icon {
            font-size: 80px;
            color: #007bff;
            margin-bottom: 15px;
        }

        .profile-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .profile-username {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .profile-details {
            text-align: left;
            margin-top: 10px;
        }

        .profile-details p {
            margin: 10px 0;
            font-size: 15px;
            color: #444;
        }

        .profile-details strong {
            width: 120px;
            display: inline-block;
            color: #222;
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <!-- Tombol kembali -->
        <a href="javascript:history.back()" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <!-- Icon profil -->
        <div class="profile-icon">
            <i class="fa-solid fa-user-circle"></i>
        </div>

        <!-- Nama & username -->
        <div class="profile-name"><?= htmlspecialchars($user['nama_lengkap']) ?></div>
        <div class="profile-username">@<?= htmlspecialchars($user['username']) ?></div>

        <!-- Detail -->
        <div class="profile-details">
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>NIK:</strong> <?= htmlspecialchars($user['nik']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($user['status']) ?></p>
        </div>
    </div>
</body>

</html>