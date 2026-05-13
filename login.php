<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ödev gereği basit ama güvenli kontrol
    if ($username === "admin" && $password === "E123_4") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h2>Admin Login</h2>
            <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>