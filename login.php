<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nama'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Wedding Organizer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Login</h2>
        </div>
        <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        <div class="menu">
            <p style="text-align:center;">Belum punya akun? <a href="register.php" class="button">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
