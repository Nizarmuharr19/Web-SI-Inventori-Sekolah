<?php
session_start();
if (!isset($_SESSION['login']) && ($_GET['page'] ?? '') != 'login') {
    header("Location: index.php?page=login");
    exit;
}
include 'koneksi.php';
$page = $_GET['page'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sistem Inventori Sekolah</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #1e3a8a;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar h2::before {
            content: '🏫';
            font-size: 24px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            margin: 8px 0;
            padding: 10px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #374ea2;
        }

        .main {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .header-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .content {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .card-boxes {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 180px;
        }

        .blue {
            background: #3b82f6;
        }

        .orange {
            background: #f59e0b;
        }

        .green {
            background: #10b981;
        }

        .purple {
            background: #8b5cf6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
        }

        table th {
            background-color: #f8fafc;
            text-align: left;
        }

        .btn {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn:hover {
            background: #2563eb;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <img src="icon.png" alt="User Icon" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
            <span style="font-size: 14px;"><?= $_SESSION['nama_lengkap'] ?></span>
        </div>

        <a href="index.php?page=dashboard" class="<?= $page == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        <a href="index.php?page=barang" class="<?= $page == 'barang' ? 'active' : '' ?>">Data Barang</a>
        <a href="index.php?page=kategori" class="<?= $page == 'kategori' ? 'active' : '' ?>">Kategori</a>
        <a href="index.php?page=lokasi" class="<?= $page == 'lokasi' ? 'active' : '' ?>">Lokasi/Ruangan</a>
        <a href="index.php?page=peminjaman" class="<?= $page == 'peminjaman' ? 'active' : '' ?>">Peminjaman</a>
        <a href="index.php?page=laporan" class="<?= $page == 'laporan' ? 'active' : '' ?>">Laporan</a>
        <a href="index.php?page=users" class="<?= $page == 'users' ? 'active' : '' ?>">Manajemen User</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main">
        <h2>Selamat datang, <?= $_SESSION['nama_lengkap'] ?>!</h2>
        <?php
        $pages = [
            'dashboard' => 'dashboard.php',
            'barang' => 'barang.php',
            'kategori' => 'kategori.php',
            'lokasi' => 'lokasi.php',
            'peminjaman' => 'peminjaman.php',
            'laporan' => 'laporan.php',
            'users' => 'users.php'
        ];
        if (isset($pages[$page])) {
            include $pages[$page];
        } else {
            echo "<h2>Halaman tidak ditemukan</h2>";
        }
        ?>
    </div>
</body>

</html>