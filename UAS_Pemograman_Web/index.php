<?php
session_start();

// Jika pengguna belum login, alihkan ke halaman login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Kode untuk halaman index.php setelah login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" type="text/css" href="assets/fa/css/all.min.css"/>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <title>Sistem Informasi Iuran RT</title>
    <!-- Tambahkan stylesheet atau link ke CSS Anda di sini -->
</head>
<body>

    <header>
        <h1>Sistem Informasi Iuran RT</h1>
        <!-- Tambahkan elemen header lainnya sesuai kebutuhan -->
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="kelola_warga.php">Kelola Data Warga</a></li>
            <li><a href="transaksi_iuran.php">Transaksi Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan Transaksi</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Tambahkan elemen menu lainnya sesuai kebutuhan -->
        </ul>
    </nav>

    <main>
        <!-- Konten utama website akan dimuat di sini -->
        <h2>Dashboard</h2>
        <div class="button-container">
            <a href="kelola_warga.php" class="page-button">Kelola Data Warga <i class="fa fa-user"></i></a>
            <a href="transaksi_iuran.php" class="page-button">Transaksi Iuran Warga <i class="fa fa-dollar-sign"></i></a>
            <a href="laporan_transaksi.php" class="page-button">Laporan Transaksi <i class="fa fa-file-text"></i></a>
            <!-- Tambahkan tombol untuk halaman lainnya sesuai kebutuhan -->
        </div>
    </main>

    <footer>
        <!-- Tambahkan footer atau informasi lainnya di sini -->
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>

</body>
</html>
