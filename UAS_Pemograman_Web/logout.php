<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan ke halaman login.php setelah logout
header("Location: login.php");
exit;
?>
