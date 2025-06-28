<?php
require_once 'db.php';

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

$pesan = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["username"]);
    $sandi = trim($_POST["password"]);

    $query = "SELECT * FROM users WHERE username = :username";
    $check = $koneksi->prepare($query);
    $check->execute(['username' => $nama]);

    if ($check->rowCount() === 1) {
        $user = $check->fetch(PDO::FETCH_ASSOC);
        if (password_verify($sandi, $user['password'])) {
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["username"] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $pesan = '<div class="feedback alert-error">Password salah.</div>';
        }
    } else {
        $pesan = '<div class="feedback alert-error">Akun tidak ditemukan.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk</title>
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <div class="wrapper">
        <h1>Login</h1>
        <?= $pesan ?>
        <form method="POST">
            <div class="input-block">
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-block">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" class="button" value="Masuk">
        </form>
        <div class="center-link">
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        </div>
    </div>
</body>
</html>
