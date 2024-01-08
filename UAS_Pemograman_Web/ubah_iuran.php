<?php
$koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

// Check connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Ambil ID iuran dari parameter URL
$id_iuran_to_edit = $_GET["id"];

// Query untuk mendapatkan data iuran berdasarkan ID
$sql_select_iuran_to_edit = "SELECT * FROM iuran WHERE id = $id_iuran_to_edit";
$result_iuran_to_edit = $koneksi->query($sql_select_iuran_to_edit);

// Cek apakah data iuran ditemukan
if ($result_iuran_to_edit->num_rows > 0) {
    $row_iuran_to_edit = $result_iuran_to_edit->fetch_assoc();
    $tanggal_iuran = $row_iuran_to_edit["tanggal"];
    $warga_id = $row_iuran_to_edit["warga_id"];
    $nominal_iuran = $row_iuran_to_edit["nominal"];
    $keterangan_iuran = $row_iuran_to_edit["keterangan"];
    $jenis_iuran = $row_iuran_to_edit["jenis_iuran"];
} else {
    echo "Data iuran tidak ditemukan.";
    exit();
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Tag head lainnya ... -->
    <title>Sistem Informasi Iuran RT - Ubah Iuran</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <link rel="stylesheet" href="css\ubah_iuran.css">
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

    <main>
        <section class="ubah-iuran">
            <h2>Ubah Iuran</h2>

            <!-- Formulir Ubah Iuran -->
            <!-- Formulir Ubah Iuran -->
<!-- Formulir Ubah Iuran -->
<form method="POST" action="proses_ubah_iuran.php">
    <input type="hidden" name="id_iuran" value="<?php echo $id_iuran_to_edit; ?>">

    <label for="tanggal_iuran">Tanggal Iuran:</label>
    <input type="date" name="tanggal_iuran" value="<?php echo $tanggal_iuran; ?>" required>

    <label for="warga_id">Warga:</label>
    <select name="warga_id" required>
        <?php
        // Ambil data warga dari database
        $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
        $sql_select_warga = "SELECT id, nama FROM warga";
        $result_warga = $koneksi->query($sql_select_warga);

        if ($result_warga->num_rows > 0) {
            while ($row_warga = $result_warga->fetch_assoc()) {
                // Pilih opsi yang sesuai dengan warga yang terkait dengan iuran
                $selected = ($row_warga["id"] == $warga_id) ? "selected" : "";
                echo "<option value='" . $row_warga["id"] . "' $selected>" . $row_warga["nama"] . "</option>";
            }
        } else {
            echo "<option value='' disabled selected>Tidak ada data warga</option>";
        }

        // Tutup koneksi
        $koneksi->close();
        ?>
    </select>

    <label for="nominal_iuran">Nominal Iuran:</label>
    <input type="number" name="nominal_iuran" step="0.01" value="<?php echo $nominal_iuran; ?>" required>

    <label for="keterangan_iuran">Keterangan:</label>
    <select name="keterangan_iuran" required>
        <option value="1" <?php if ($keterangan_iuran == "Sudah Bayar") echo "selected"; ?>>Sudah Bayar</option>
        <option value="0" <?php if ($keterangan_iuran == "Belum Bayar") echo "selected"; ?>>Belum Bayar</option>
    </select>

    <label for="jenis_iuran">Jenis Iuran:</label>
    <select name="jenis_iuran" required>
        <option value="1" <?php if ($jenis_iuran == 1) echo "selected"; ?>>Kas</option>
        <option value="2" <?php if ($jenis_iuran == 2) echo "selected"; ?>>Sampah</option>
        <option value="3" <?php if ($jenis_iuran == 3) echo "selected"; ?>>Sumbangan</option>
    </select>

    <button type="submit" name="simpan_ubahan_iuran">Simpan Perubahan</button>
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
