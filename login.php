<?php
session_start();
include 'db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header("Location: admin.php");
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === "admin" && $password === "E123_4") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Hatalı kullanıcı adı veya şifre.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Giriş — Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page-auth">
  <div class="auth-backdrop" aria-hidden="true"></div>
  <main class="auth-main">
    <a class="auth-brand" href="index.php">
      <span class="auth-brand-initials">EK</span>
      <span class="auth-brand-label">Portfolio Yönetimi</span>
    </a>

    <div class="auth-card">
      <p class="auth-eyebrow">Yönetici</p>
      <h1 class="auth-title">Giriş</h1>
      <p class="auth-lead">Devam etmek için oturum açın.</p>

      <?php if ($error !== ''): ?>
        <div class="auth-alert" role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
      <?php endif; ?>

      <form class="auth-form" method="POST" action="">
        <div class="auth-field">
          <label for="username">Kullanıcı adı</label>
          <input type="text" id="username" name="username" placeholder="admin" required autocomplete="username">
        </div>
        <div class="auth-field">
          <label for="password">Şifre</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
        </div>
        <button type="submit" class="auth-submit">
          <span>Giriş Yap</span>
          <span class="auth-submit-arrow">→</span>
        </button>
      </form>

      <p class="auth-footer"><a href="index.php">← Ana siteye dön</a></p>
    </div>
  </main>
</body>
</html>
