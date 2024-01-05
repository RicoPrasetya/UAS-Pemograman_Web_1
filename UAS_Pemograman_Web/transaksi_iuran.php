

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Bagian head, termasuk link CSS dan lainnya ... -->
    <link rel="stylesheet" href="css\transaksi_iuran.css">
    <title>Sistem Informasi Iuran RT</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
</head>
<body>

    <!-- Bagian Header -->
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

    <!-- Bagian Konten -->
    <main>
            <!-- Daftar KAS Warga -->
            <h2>Daftar KAS Warga</h2>

            <a href="tambah_iuran.php" class="tombol-tambah">Tambah iuran</a>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>ID Warga</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Jenis Iuran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data iuran dari database dan tampilkan di tabel
                    // Sesuaikan kueri dan struktur tabel dengan database Anda
                    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
                    $sql_select_iuran = "SELECT * FROM iuran";
                    $result_iuran = $koneksi->query($sql_select_iuran);

                    if ($result_iuran->num_rows > 0) {
                        while ($row_iuran = $result_iuran->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row_iuran["tanggal"] . "</td>";
                            // Tampilkan nama warga (sesuaikan dengan struktur tabel dan kueri yang benar)
                            echo "<td>" . $row_iuran["warga_id"] . "</td>";
                            echo "<td>" . $row_iuran["nominal"] . "</td>";
                            echo "<td>" . $row_iuran["keterangan"] . "</td>";
                            echo "<td>" . $row_iuran["jenis_iuran"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data iuran.</td></tr>";
                    }

                    // Tutup koneksi
                    $koneksi->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Bagian Footer -->
    <footer>
        <!-- Tambahkan footer atau informasi lainnya di sini -->
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>

</body>
</html>
