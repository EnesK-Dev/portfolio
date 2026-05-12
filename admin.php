<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Yeni Proje Ekleme Mantığı
if (isset($_POST['add_project'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    mysqli_query($conn, "INSERT INTO projects (title, description) VALUES ('$title', '$desc')");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h1>Admin Panel</h1>
        <a href="logout.php">Çıkış Yap</a>
    </nav>

    <section>
        <h3>Yeni Proje Ekle</h3>
        <form method="POST">
            <input type="text" name="title" placeholder="Proje Başlığı" required>
            <textarea name="desc" placeholder="Proje Açıklaması"></textarea>
            <button type="submit" name="add_project">Ekle</button>
        </form>
    </section>

    <hr>

    <section>
        <h3>Gelen Mesajlar</h3>
        <table border="1">
            <tr><th>Ad</th><th>Email</th><th>Mesaj</th></tr>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM messages ORDER BY submitted_at DESC");
            while($row = mysqli_fetch_assoc($res)) {
                echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['message']}</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>