<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_POST['add_project'])) {
    $title = trim($_POST['title'] ?? '');
    $desc = trim($_POST['desc'] ?? '');
    if ($title !== '') {
        $stmt = mysqli_prepare($conn, "INSERT INTO projects (title, description) VALUES (?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $title, $desc);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    header("Location: admin.php");
    exit();
}

if (isset($_POST['delete_project'])) {
    $id = (int)($_POST['project_id'] ?? 0);
    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM projects WHERE id = ? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    header("Location: admin.php");
    exit();
}

if (isset($_POST['delete_message'])) {
    $id = (int)($_POST['message_id'] ?? 0);
    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM messages WHERE id = ? LIMIT 1");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    header("Location: admin.php");
    exit();
}

$projects_res = mysqli_query($conn, "SELECT id, title, description FROM projects ORDER BY id DESC");
$messages_res = mysqli_query($conn, "SELECT id, name, email, message, submitted_at FROM messages ORDER BY submitted_at DESC");
if (!$messages_res) {
    $messages_res = mysqli_query($conn, "SELECT id, name, email, message FROM messages ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html lang="tr" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel — Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page-admin">
  <header class="admin-topbar">
    <div class="admin-topbar-inner">
      <div class="admin-topbar-brand">
        <span class="admin-topbar-mark">EK</span>
        <div>
          <span class="admin-topbar-title">Yönetim</span>
          <span class="admin-topbar-sub">Projeler &amp; mesajlar</span>
        </div>
      </div>
      <div class="admin-topbar-actions">
        <a class="admin-btn admin-btn-ghost" href="index.php" target="_blank" rel="noopener">Siteyi aç</a>
        <a class="admin-btn admin-btn-danger-outline" href="logout.php">Çıkış</a>
      </div>
    </div>
  </header>

  <main class="admin-main">
    <div class="admin-layout">
      <section class="admin-card admin-card-form">
        <p class="admin-card-eyebrow">01 — Proje</p>
        <h2 class="admin-card-title">Yeni proje ekle</h2>
        <form class="admin-form" method="POST" action="">
          <div class="admin-field">
            <label for="title">Başlık</label>
            <input type="text" id="title" name="title" placeholder="Örn. E-ticaret API" required>
          </div>
          <div class="admin-field">
            <label for="desc">Açıklama</label>
            <textarea id="desc" name="desc" rows="4" placeholder="Kısa açıklama, kullanılan teknolojiler…"></textarea>
          </div>
          <button type="submit" name="add_project" value="1" class="admin-btn admin-btn-primary">Projeyi kaydet</button>
        </form>
      </section>

      <section class="admin-card admin-card-list">
        <p class="admin-card-eyebrow">02 — Kayıtlı projeler</p>
        <h2 class="admin-card-title">Projeler</h2>
        <?php if ($projects_res && mysqli_num_rows($projects_res) > 0): ?>
          <ul class="admin-project-list">
            <?php while ($p = mysqli_fetch_assoc($projects_res)): ?>
              <li class="admin-project-item">
                <div class="admin-project-body">
                  <h3 class="admin-project-name"><?php echo htmlspecialchars($p['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                  <p class="admin-project-desc"><?php echo nl2br(htmlspecialchars($p['description'] ?? '', ENT_QUOTES, 'UTF-8')); ?></p>
                </div>
                <form method="POST" class="admin-inline-form" onsubmit="return confirm('Bu projeyi silmek istediğinize emin misiniz?');">
                  <input type="hidden" name="project_id" value="<?php echo (int)$p['id']; ?>">
                  <button type="submit" name="delete_project" value="1" class="admin-btn admin-btn-icon danger" title="Sil">Sil</button>
                </form>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php else: ?>
          <p class="admin-empty">Henüz proje yok. Soldaki formdan ekleyebilirsiniz.</p>
        <?php endif; ?>
      </section>
    </div>

    <section class="admin-card admin-card-wide">
      <div class="admin-messages-head">
        <div>
          <p class="admin-card-eyebrow">03 — Gelen kutusu</p>
          <h2 class="admin-card-title">Mesajlar</h2>
        </div>
        <p class="admin-messages-hint">Okuduğunuz mesajları aşağıdan silebilirsiniz.</p>
      </div>

      <?php if ($messages_res && mysqli_num_rows($messages_res) > 0): ?>
        <div class="admin-message-grid">
          <?php while ($m = mysqli_fetch_assoc($messages_res)): ?>
            <article class="admin-message-card">
              <header class="admin-message-meta">
                <strong><?php echo htmlspecialchars($m['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                <span class="admin-message-date"><?php echo htmlspecialchars($m['submitted_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
              </header>
              <a class="admin-message-email" href="mailto:<?php echo htmlspecialchars($m['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($m['email'], ENT_QUOTES, 'UTF-8'); ?></a>
              <p class="admin-message-text"><?php echo nl2br(htmlspecialchars($m['message'], ENT_QUOTES, 'UTF-8')); ?></p>
              <form method="POST" class="admin-message-actions" onsubmit="return confirm('Bu mesajı silmek istediğinize emin misiniz?');">
                <input type="hidden" name="message_id" value="<?php echo (int)$m['id']; ?>">
                <button type="submit" name="delete_message" value="1" class="admin-btn admin-btn-small danger">Mesajı sil</button>
              </form>
            </article>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p class="admin-empty">Henüz mesaj yok.</p>
      <?php endif; ?>
    </section>
  </main>
</body>
</html>
