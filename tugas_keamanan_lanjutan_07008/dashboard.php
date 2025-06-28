<?php
require_once 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <div class="wrapper">
        <h1>Hai, <?= htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <p class="center-link">Selamat datang di halaman dashboard.</p>
        <p class="center-link"><a href="logout.php">Keluar</a></p>
    </div>
</body>
</html>
