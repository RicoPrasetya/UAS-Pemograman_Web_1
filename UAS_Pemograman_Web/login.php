<?php
session_start();

// Jika pengguna sudah login, alihkan ke index.php
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "db_kas_rt");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Lakukan validasi login (gantilah dengan hash yang sesuai di database)
    $sql = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil, set session dan alihkan ke index.php
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        header("Location: index.php");
        exit;
    } else {
        // Login gagal, tampilkan pesan error
        $error_message = "Username atau password salah!";
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/kas.png" type="image/png">
    <link rel="shortcut icon" href="img/kas.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
    <!-- Tambahkan link CSS sesuai kebutuhan -->
</head>
<body>

    <main>
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="logo-container">
        <img src="img/kas.png" alt="Logo Kas">
        <h1>Sistem Informasi iuran RT</h1>
        </div>
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
            <p class="copyright">Copyright © 2024 Sistem Informasi RT</p>
        </form>
    </main>

</body>
</html>
