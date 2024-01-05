<?php
// Logika untuk mendapatkan data warga yang belum membayar iuran
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cari_warga_belum_bayar"])) {
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $jenis_iuran_filter = $_POST["jenis_iuran_filter"];

    // Implementasikan logika untuk mendapatkan data warga yang belum membayar iuran
    // Sesuaikan dengan struktur tabel dan logika bisnis Anda
    // ...

    // Simpan hasil query ke dalam array $data_warga_belum_bayar
    $data_warga_belum_bayar = array();
    // ...

    // Tampilkan pesan jika tidak ada data yang ditemukan
    if (empty($data_warga_belum_bayar)) {
        echo "<p>Tidak ada data warga yang belum membayar iuran untuk bulan $bulan tahun $tahun.</p>";
    }
}

// Logika untuk mendapatkan data jumlah KAS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cari_jumlah_kas"])) {
    $periode = $_POST["periode"];
    $jenis_iuran_filter_kas = $_POST["jenis_iuran_filter_kas"];

    // Implementasikan logika untuk mendapatkan data jumlah KAS
    // Sesuaikan dengan struktur tabel dan logika bisnis Anda
    // ...

    // Simpan hasil query ke dalam variabel $jumlah_kas
    $jumlah_kas = 0;
    // ...

    // Tampilkan pesan jika tidak ada data yang ditemukan
    if (empty($jumlah_kas)) {
        echo "<p>Tidak ada data jumlah KAS untuk periode $periode.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Bagian head, termasuk link CSS dan lainnya ... -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Iuran RT</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <link rel="stylesheet" href="css\laporan_transaksi.css">
    <link rel="stylesheet" type="text/css" href="assets/fa/css/all.min.css"/>
</head>
<body>

    <header>
        <h1>Sistem Informasi Iuran RT</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="kelola_warga.php">Kelola Data Warga</a></li>
            <li><a href="transaksi_iuran.php">Transaksi Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan Transaksi</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Bagian Konten -->
    <main>
        <section class="laporan-transaksi">
            <h2>Laporan Transaksi</h2>

            <!-- Formulir Data Warga yang Belum Membayar Iuran -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h3>Data Warga yang Belum Membayar Iuran</h3>
                <label for="bulan">Bulan:</label>
                <input type="text" name="bulan" required>

                <label for="tahun">Tahun:</label>
                <input type="text" name="tahun" required>

                <label for="jenis_iuran_filter">Jenis Iuran:</label>
                <select name="jenis_iuran_filter">
                    <!-- Isi opsi sesuai dengan jenis iuran di database -->
                    <option value="1">Kas</option>
                    <option value="2">Sampah</option>
                    <option value="2">Sumbangan</option>
                    <!-- ... -->
                </select>

                <button type="submit" name="cari_warga_belum_bayar">Cari</button>
            </form>

            <!-- Tampilkan Data Warga yang Belum Membayar Iuran -->
            <?php
            // Implementasikan tampilan data warga yang belum membayar iuran di sini
            // Gunakan variabel $data_warga_belum_bayar
            // ...
            ?>

            <!-- Formulir Jumlah KAS -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h3>Data Jumlah KAS</h3>
                <label for="periode">Periode:</label>
                <input type="text" name="periode" required>

                <label for="jenis_iuran_filter_kas">Jenis Iuran:</label>
                <select name="jenis_iuran_filter_kas">
                    <!-- Isi opsi sesuai dengan jenis iuran di database -->
                    <option value="1">Kas</option>
                    <option value="2">Sampah</option>
                    <option value="2">Sumbangan</option>
                    <!-- ... -->
                </select>

                <button type="submit" name="cari_jumlah_kas">Cari</button>
            </form>

            <!-- Tampilkan Data Jumlah KAS -->
            <?php
            // Implementasikan tampilan data jumlah KAS di sini
            // Gunakan variabel $jumlah_kas
            // ...
            ?>
        </section>
    </main>

    <!-- Bagian Footer -->
    <footer>
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>

</body>
</html>
