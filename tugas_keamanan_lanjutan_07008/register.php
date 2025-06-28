<?php
require_once 'db.php';
$info = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim($_POST["username"]);
    $pass = trim($_POST["password"]);

    if ($user === "" || $pass === "") {
        $info = '<div class="feedback alert-error">Field tidak boleh kosong.</div>';
    } else {
        $cek = $koneksi->prepare("SELECT id FROM users WHERE username = :user");
        $cek->execute(['user' => $user]);

        if ($cek->rowCount() > 0) {
            $info = '<div class="feedback alert-error">Username sudah digunakan.</div>';
        } else {
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $input = $koneksi->prepare("INSERT INTO users (username, password) VALUES (:user, :pass)");
            $sukses = $input->execute(['user' => $user, 'pass' => $pass_hash]);

            if ($sukses) {
                header("Location: login.php?registered=true");
                exit;
            } else {
                $info = '<div class="feedback alert-error">Terjadi kesalahan saat menyimpan.</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar</title>
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <div class="wrapper">
        <h1>Registrasi</h1>
        <?= $info ?>
        <form method="POST">
            <div class="input-block">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-block">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" class="button" value="Daftar">
        </form>
        <div class="center-link">
            <p>Sudah punya akun? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
