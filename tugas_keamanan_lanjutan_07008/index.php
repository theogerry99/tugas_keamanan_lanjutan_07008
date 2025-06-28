<?php
require_once 'db.php';

// Jika sudah login, arahkan ke dashboard
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Selamat Datang di Aplikasi Login</h2>
        <p class="text-center">Silakan <a href="login.php">Login</a> atau <a href="register.php">Daftar</a> untuk melanjutkan.</p>
    </div>
</body>
</html>
