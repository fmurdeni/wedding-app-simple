<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];

    $sql = "INSERT INTO clients (nama, email, password, telepon) VALUES ('$nama', '$email', '$password', '$telepon')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Wedding Organizer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Registrasi</h2>
        </div>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="tel" name="telepon" placeholder="Nomor Telepon"><br>
            <input type="submit" value="Daftar">
        </form>
        <div class="menu">
            <p style="text-align:center;">Sudah punya akun? <a href="login.php" class="button">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
