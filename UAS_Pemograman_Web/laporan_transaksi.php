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
            <li><a href="transaksi_iuran.php">Iuran Warga</a></li>
            <li><a href="laporan_transaksi.php">Laporan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Bagian Konten -->
    <main>
        <section class="laporan-iuran">
            <h2>Data Warga Sudah Bayar Iuran</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Warga</th>
                        <th>Nominal</th>
                        <th>Jenis Iuran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data iuran dengan keterangan "Sudah Bayar" dari database
                    // Sesuaikan kueri dan struktur tabel dengan database Anda
                    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
                    $sql_select_iuran_sudah_bayar = "SELECT iuran.tanggal, warga.nama, iuran.nominal, iuran.jenis_iuran
                                                     FROM iuran
                                                     JOIN warga ON iuran.warga_id = warga.id
                                                     WHERE iuran.keterangan = 'Sudah Bayar'";

                    $result_iuran_sudah_bayar = $koneksi->query($sql_select_iuran_sudah_bayar);

                    if ($result_iuran_sudah_bayar->num_rows > 0) {
                        while ($row_iuran_sudah_bayar = $result_iuran_sudah_bayar->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row_iuran_sudah_bayar["tanggal"] . "</td>";
                            echo "<td>" . $row_iuran_sudah_bayar["nama"] . "</td>";
                            echo "<td>" . $row_iuran_sudah_bayar["nominal"] . "</td>";
                            echo "<td>" . $row_iuran_sudah_bayar["jenis_iuran"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data iuran sudah bayar.</td></tr>";
                    }

                    // Tutup koneksi
                    $koneksi->close();
                    ?>
                </tbody>
            </table>
        </section>

        <section class="laporan-iuran">
            <h2>Data Warga Belum Bayar Iuran</h2>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Warga</th>
                        <th>Nominal</th>
                        <th>Jenis Iuran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil data iuran dengan keterangan "Belum Bayar" dari database
                    // Sesuaikan kueri dan struktur tabel dengan database Anda
                    $koneksi = new mysqli("localhost", "root", "", "db_kas_rt");
                    $sql_select_iuran_belum_bayar = "SELECT iuran.tanggal, warga.nama, iuran.nominal, iuran.jenis_iuran
                                                     FROM iuran
                                                     JOIN warga ON iuran.warga_id = warga.id
                                                     WHERE iuran.keterangan = 'Belum Bayar'";

                    $result_iuran_belum_bayar = $koneksi->query($sql_select_iuran_belum_bayar);

                    if ($result_iuran_belum_bayar->num_rows > 0) {
                        while ($row_iuran_belum_bayar = $result_iuran_belum_bayar->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row_iuran_belum_bayar["tanggal"] . "</td>";
                            echo "<td>" . $row_iuran_belum_bayar["nama"] . "</td>";
                            echo "<td>" . $row_iuran_belum_bayar["nominal"] . "</td>";
                            echo "<td>" . $row_iuran_belum_bayar["jenis_iuran"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data iuran belum bayar.</td></tr>";
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
        <p>Copyright &copy; 2024 Sistem Informasi Iuran RT</p>
    </footer>

</body>
</html>
