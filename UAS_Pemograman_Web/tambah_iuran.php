<?php
// Pastikan Anda menambahkan logika untuk menyimpan data iuran baru
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan_iuran"])) {
    // Tangkap data yang ditambahkan dari formulir
    $tanggal_iuran = $_POST["tanggal_iuran"];
    $warga_id = $_POST["warga_id"];
    $nominal_iuran = $_POST["nominal_iuran"];
    $keterangan_iuran = $_POST["keterangan_iuran"];
    $jenis_iuran = $_POST["jenis_iuran"];

    // Lakukan kueri SQL INSERT untuk menyimpan data iuran baru
    // Sesuaikan kueri ini sesuai dengan struktur tabel
    // Gunakan prepared statement untuk menghindari serangan SQL injection
    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Kueri SQL INSERT
    $sql_insert_iuran = "INSERT INTO iuran (tanggal, warga_id, nominal, keterangan, jenis_iuran) VALUES (?, ?, ?, ?, ?)";

    // Gunakan prepared statement
    $stmt_insert_iuran = $koneksi->prepare($sql_insert_iuran);
    $stmt_insert_iuran->bind_param("sidsi", $tanggal_iuran, $warga_id, $nominal_iuran, $keterangan_iuran, $jenis_iuran);

    // Eksekusi kueri
    if ($stmt_insert_iuran->execute()) {
        // Setelah berhasil menyimpan data, alihkan kembali ke halaman transaksi_iuran.php
        header("Location: transaksi_iuran.php");
        exit();
    } else {
        echo "Error: " . $sql_insert_iuran . "<br>" . $koneksi->error;
    }

    // Tutup statement dan koneksi
    $stmt_insert_iuran->close();
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
    <link rel="stylesheet" href="css\tambah_iuran.css">
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
            <li><a href="transaksi_iuran.php">Transaksi Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan Transaksi</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Tambahkan elemen menu lainnya sesuai kebutuhan -->
        </ul>
    </nav>

    <main>
        <section class="transaksi-iuran">
            <h2>Transaksi Iuran</h2>

            <!-- Formulir Tambah Iuran -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="tanggal_iuran">Tanggal Iuran:</label>
                <input type="date" name="tanggal_iuran" required>

                <label for="warga_id">Warga:</label>
                <!-- Pilih Warga dari data yang ada di database -->
                <select name="warga_id" required>
                <?php
        // Ambil data warga dari database
        $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
        $sql_select_warga = "SELECT id, nama FROM warga";
        $result_warga = $koneksi->query($sql_select_warga);

        if ($result_warga->num_rows > 0) {
            while ($row_warga = $result_warga->fetch_assoc()) {
                echo "<option value='" . $row_warga["id"] . "'>" . $row_warga["nama"] . "</option>";
            }
        } else {
            echo "<option value='' disabled selected>Tidak ada data warga</option>";
        }

        // Tutup koneksi
        $koneksi->close();
        ?>
                    <!-- Isi opsi sesuai dengan data warga di database -->
                    <!-- Contoh: <option value="1">Nama Warga 1</option> -->
                </select>

                <label for="nominal_iuran">Nominal Iuran:</label>
                <input type="number" name="nominal_iuran" step="0.01" required>

                <label for="keterangan_iuran">Keterangan:</label>
                <textarea name="keterangan_iuran"></textarea>

                <label for="jenis_iuran">Jenis Iuran:</label>
                <select name="jenis_iuran" required>
                    <option value="1">Kas</option>
                    <option value="2">Sampah</option>
                    <option value="2">Sumbangan</option>
                    <!-- Isi opsi sesuai dengan jenis iuran di database -->
                </select>

                <button type="submit" name="simpan_iuran">Simpan Iuran</button>
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
