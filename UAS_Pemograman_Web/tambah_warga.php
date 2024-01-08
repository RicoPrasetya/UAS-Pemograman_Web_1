<?php
// Pastikan Anda memasukkan logika untuk menyimpan data warga baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan_data"])) {
    // Tangkap data yang ditambahkan dari formulir
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $no_hp = $_POST["no_hp"];
    $alamat = $_POST["alamat"];
    $no_rumah = $_POST["no_rumah"];
    $status = $_POST["status"];

    // Lakukan kueri SQL INSERT untuk menyimpan data warga baru
    // Sesuaikan kueri ini sesuai dengan struktur tabel
    // Gunakan prepared statement untuk menghindari serangan SQL injection
    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Kueri SQL INSERT
    $sql_insert = "INSERT INTO warga (nik, nama, jenis_kelamin, no_hp, alamat, no_rumah, status) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Gunakan prepared statement
    $stmt_insert = $koneksi->prepare($sql_insert);
    $stmt_insert->bind_param("isssssi", $nik, $nama, $jenis_kelamin, $no_hp, $alamat, $no_rumah, $status);

    // Eksekusi kueri
    if ($stmt_insert->execute()) {
        // Setelah berhasil menyimpan data, alihkan kembali ke halaman kelola_warga.php
        header("Location: kelola_warga.php");
        exit();
    } else {
        echo "Error: " . $sql_insert . "<br>" . $koneksi->error;
    }

    // Tutup statement dan koneksi
    $stmt_insert->close();
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Tag head lainnya ... -->
    <title>Sistem Informasi Iuran RT</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <link rel="stylesheet" href="css\tambah_warga.css">
</head>
<body>

    <!-- ... Bagian-bagian lainnya ... -->
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
    <!-- Bagian Konten Formulir Tambah Warga -->
    <main>
        <section class="tambah-warga">
            <h2>Tambah Data Warga Baru</h2>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="nik">NIK:</label>
                <input type="text" name="nik" required>

                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>

                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" required>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>

                <label for="no_hp">No. HP:</label>
                <input type="text" name="no_hp" required>

                <label for="alamat">Alamat:</label>
                <textarea name="alamat" required></textarea>

                <label for="no_rumah">No. Rumah:</label>
                <input type="text" name="no_rumah" required>

                <label for="status">Status:</label>
                <select name="status" required>
                    <option value="1">Aktif</option>
                    <option value="0">Non-Aktif</option>
                </select>

                <!-- Tambahkan elemen formulir lain sesuai kebutuhan -->
                <!-- ... -->

                <button type="submit" name="simpan_data">Simpan Data</button>
            </form>
        </section>
    </main>

    <!-- ... Bagian-bagian lainnya ... -->
    <footer>
        <!-- Tambahkan footer atau informasi lainnya di sini -->
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>
</body>
</html>
