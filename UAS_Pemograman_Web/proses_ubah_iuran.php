<?php
// Pastikan Anda menambahkan logika untuk menyimpan perubahan data iuran
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan_ubahan_iuran"])) {
    // Tangkap data yang diubah dari formulir
    $id_iuran = $_POST["id_iuran"];
    $tanggal_iuran = $_POST["tanggal_iuran"];
    $warga_id = $_POST["warga_id"];
    $nominal_iuran = $_POST["nominal_iuran"];
    $keterangan_iuran = ($_POST["keterangan_iuran"] == 1) ? "Sudah Bayar" : "Belum Bayar";
    $jenis_iuran = $_POST["jenis_iuran"];

    // Lakukan kueri SQL UPDATE untuk menyimpan perubahan data iuran
    // Sesuaikan kueri ini sesuai dengan struktur tabel dan logika bisnis Anda
    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Kueri SQL UPDATE
    $sql_update_iuran = "UPDATE iuran SET tanggal=?, warga_id=?, nominal=?, keterangan=?, jenis_iuran=? WHERE id=?";
    
    // Gunakan prepared statement
    $stmt_update_iuran = $koneksi->prepare($sql_update_iuran);
    $stmt_update_iuran->bind_param("sidsii", $tanggal_iuran, $warga_id, $nominal_iuran, $keterangan_iuran, $jenis_iuran, $id_iuran);

    // Eksekusi kueri
    if ($stmt_update_iuran->execute()) {
        // Setelah berhasil menyimpan perubahan data, alihkan kembali ke halaman transaksi_iuran.php
        header("Location: transaksi_iuran.php");
        exit();
    } else {
        echo "Error: " . $sql_update_iuran . "<br>" . $koneksi->error;
    }

    // Tutup statement dan koneksi
    $stmt_update_iuran->close();
    $koneksi->close();
}
?>
