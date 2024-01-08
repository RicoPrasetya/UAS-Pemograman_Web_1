<?php
// Pastikan Anda memasukkan logika untuk mengambil data warga yang akan diubah
// Gunakan nilai yang dikirimkan dari halaman kelola_warga.php (ID warga)
$warga_id_to_edit = $_GET['id'];

// Simulasikan pengambilan data warga dari database
// Gantilah dengan logika sesuai dengan kebutuhan Anda
$koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Kueri SQL SELECT untuk mendapatkan data warga yang akan diubah
$sql = "SELECT * FROM warga WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $warga_id_to_edit);

// Eksekusi kueri
$stmt->execute();

// Simpan hasil kueri ke dalam variabel
$result = $stmt->get_result();
$data_warga_to_edit = $result->fetch_assoc();

// Tutup statement
$stmt->close();

// Tutup koneksi
$koneksi->close();

// Logika untuk menyimpan perubahan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan_perubahan"])) {
    // Tangkap data yang diubah dari formulir
    $nik_baru = $_POST["nik_baru"];
    $nama_baru = $_POST["nama_baru"];
    $jenis_kelamin_baru = $_POST["jenis_kelamin_baru"];
    $no_hp_baru = $_POST["no_hp_baru"];
    $alamat_baru = $_POST["alamat_baru"];
    $no_rumah_baru = $_POST["no_rumah_baru"];
    $status_baru = $_POST["status_baru"];

    // Lakukan kueri SQL UPDATE untuk mengubah data warga
    // Sesuaikan kueri ini sesuai dengan struktur tabel dan data yang akan diubah
    // Gunakan prepared statement untuk menghindari serangan SQL injection
    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Kueri SQL UPDATE
    $sql_update = "UPDATE warga SET
            nik = ?,
            nama = ?,
            jenis_kelamin = ?,
            no_hp = ?,
            alamat = ?,
            no_rumah = ?,
            status = ?
            WHERE id = ?";

    // Gunakan prepared statement
    $stmt_update = $koneksi->prepare($sql_update);
    $stmt_update->bind_param("issssssi",$nik_baru, $nama_baru, $jenis_kelamin_baru, $no_hp_baru, $alamat_baru, $no_rumah_baru, $status_baru, $warga_id_to_edit);

    // Eksekusi kueri
    if ($stmt_update->execute()) {
        // Setelah berhasil mengubah data, alihkan kembali ke halaman kelola_warga.php
        header("Location: kelola_warga.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $koneksi->error;
    }

    // Tutup statement dan koneksi
    $stmt_update->close();
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Tag head lainnya ... -->
    <link rel="stylesheet" href="css\ubah_warga.css">
    <title>Sistem Informasi Iuran RT</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
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
            <li><a href="transaksi_iuran.php">Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Tambahkan elemen menu lainnya sesuai kebutuhan -->
        </ul>
    </nav>
    <!-- ... Bagian-bagian lainnya ... -->

    <!-- Bagian Konten Formulir Ubah Warga -->
    <main>
        <section class="ubah-warga">
            <h2>Ubah Data Warga</h2>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $warga_id_to_edit; ?>">
            <label for="nik_baru">NIK Baru:</label>
                <input type="text" name="nik_baru" value="<?php echo $data_warga_to_edit['nik']; ?>" required>
            
                <label for="nama_baru">Nama Baru:</label>
                <input type="text" name="nama_baru" value="<?php echo $data_warga_to_edit['nama']; ?>" required>

                <label for="jenis_kelamin_baru">Jenis Kelamin Baru:</label>
                <select name="jenis_kelamin_baru">
                    <option value="L" <?php echo ($data_warga_to_edit['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                    <option value="P" <?php echo ($data_warga_to_edit['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>

                <label for="no_hp_baru">Nomor HP Baru:</label>
                <input type="text" name="no_hp_baru" value="<?php echo $data_warga_to_edit['no_hp']; ?>" required>

                <label for="alamat_baru">Alamat Baru:</label>
                <textarea name="alamat_baru" required><?php echo $data_warga_to_edit['alamat']; ?></textarea>

                <label for="no_rumah_baru">Nomor Rumah Baru:</label>
                <input type="text" name="no_rumah_baru" value="<?php echo $data_warga_to_edit['no_rumah']; ?>" required>

                <label for="status_baru">Status Baru:</label>
                <select name="status_baru">
                    <option value="1" <?php echo ($data_warga_to_edit['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo ($data_warga_to_edit['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>

                <!-- Tambahkan elemen formulir lain sesuai kebutuhan -->
                <!-- ... -->

                <button type="submit" name="simpan_perubahan">Simpan Perubahan</button>
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

