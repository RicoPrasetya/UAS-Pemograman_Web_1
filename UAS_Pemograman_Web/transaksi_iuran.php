<?php
$koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Proses penghapusan iuran
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_iuran"])) {
    $id_iuran_to_delete = $_POST["hapus_iuran"];

    // Query hapus iuran sesuai dengan ID
    $sql_delete_iuran = "DELETE FROM iuran WHERE id = $id_iuran_to_delete";

    if ($koneksi->query($sql_delete_iuran) === TRUE) {
        echo "<script>alert('Iuran berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Error: " . $koneksi->error . "');</script>";
    }
}

// ... (Kode sebelumnya untuk menampilkan data iuran tetap sama)
?>


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
            <li><a href="transaksi_iuran.php">Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Tambahkan elemen menu lainnya sesuai kebutuhan -->
        </ul>
    </nav>

    <!-- Bagian Konten -->
    <main>
            <!-- Daftar KAS Warga -->
            <h2>Daftar Iuran Warga</h2>

            <a href="tambah_iuran.php" class="tombol-tambah">Tambah iuran</a>
            <table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Warga</th>
            <th>Nominal</th>
            <th>Keterangan</th>
            <th>Jenis Iuran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
        $sql_select_iuran = "SELECT * FROM iuran";
        $result_iuran = $koneksi->query($sql_select_iuran);

        if ($result_iuran->num_rows > 0) {
            while ($row_iuran = $result_iuran->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_iuran["tanggal"] . "</td>";
                // Ambil data warga berdasarkan ID
$warga_id = $row_iuran["warga_id"];
$koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
$sql_select_warga = "SELECT nama FROM warga WHERE id = $warga_id";
$result_warga = $koneksi->query($sql_select_warga);

if ($result_warga->num_rows > 0) {
    $row_warga = $result_warga->fetch_assoc();
    $nama_warga = $row_warga["nama"];
} else {
    $nama_warga = "Nama Warga Tidak Ditemukan";
}
                // Tampilkan nama warga (sesuaikan dengan struktur tabel dan kueri yang benar)
                echo "<td>" . $nama_warga . "</td>";
                echo "<td>" . $row_iuran["nominal"] . "</td>";
                echo "<td>" . $row_iuran["keterangan"] . "</td>";
                echo "<td>" . $row_iuran["jenis_iuran"] . "</td>";
                // ...
echo "<td>";
echo "<form method='POST' action='ubah_iuran.php?id=" . $row_iuran['id'] . "'>";
echo "<input type='hidden' name='ubah_iuran' value='" . $row_iuran['id'] . "'>";
echo "<button type='submit' class='ubah-iuran-btn'>Ubah</button>";
echo "</form>";
echo "<form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
echo "<input type='hidden' name='hapus_iuran' value='" . $row_iuran['id'] . "'>";
echo "<button type='submit' class='hapus-iuran-btn' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\");'>Hapus</button>";
echo "</form>";
echo "</td>";
// ...

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data iuran.</td></tr>";
        }

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
