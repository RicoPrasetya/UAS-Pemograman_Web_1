<!-- kelola_warga.php -->

<?php
// Hubungkan dengan database (sesuaikan dengan detail koneksi Anda)
$host = "localhost";
$username = "root";
$password = "";
$database = "db_kas_rt";

$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Fungsi untuk mendapatkan data warga
function getWargaData($conn) {
    $sql = "SELECT * FROM warga";
    $result = $conn->query($sql);

    $wargaData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $wargaData[] = $row;
        }
    }

    return $wargaData;
}

// Hapus Warga
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_warga"])) {
    $warga_id = $_POST["hapus_warga"];

    $sql = "DELETE FROM warga WHERE id = '$warga_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: kelola_warga.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data warga
$wargaData = getWargaData($conn);

// Tutup koneksi database
$conn->close();
?>

<!-- Bagian Header -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Iuran RT</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <link rel="stylesheet" href="css\kelola_data_warga.css">
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

    <main>

<!-- Bagian Konten Kelola Warga -->
        <section class="kelola-warga">
            <h2>Kelola Data Warga</h2>

            <!-- Form Tambah Warga -->
            <a href="tambah_warga.php" class="tombol-tambah">Tambah Warga</a>

            <!-- Tabel Data Warga -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>No. Rumah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wargaData as $warga) : ?>
                        <tr>
                            <td><?php echo $warga["id"]; ?></td>
                            <td><?php echo $warga["nik"]; ?></td>
                            <td><?php echo $warga["nama"]; ?></td>
                            <td><?php echo ($warga["jenis_kelamin"] == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td>
                            <td><?php echo $warga["no_hp"]; ?></td>
                            <td><?php echo $warga["alamat"]; ?></td>
                            <td><?php echo $warga["no_rumah"]; ?></td>
                            <td><?php echo ($warga["status"] == 1) ? 'Aktif' : 'Non-Aktif'; ?></td>
                            <td>
                                <form method="POST" action="ubah_warga.php?id=<?php echo $warga['id']; ?>">
                                    <input type="hidden" name="ubah_warga" value="<?php echo $warga["id"]; ?>">
                                    <button type="submit" class="ubah-warga">Ubah</button>
                                </form>

                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="hapus_warga" value="<?php echo $warga["id"]; ?>">
                                    <button type="submit" class="hapus-warga" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

    </main>

    <!-- Bagian Footer -->
    <footer>
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>

</body>
</html>
