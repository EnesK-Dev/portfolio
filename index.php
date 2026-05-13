<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Software Portfolio</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="navbar">
    <a class="nav-logo" href="#">
      <span class="logo-initials">EK</span>
      <span class="logo-label">My Digital Identity</span>
    </a>
    <div class="nav-right">
      <a href="#projects-section">Projects</a>
      <a href="#contact-section">Contact</a>
      <button type="button" id="theme-toggle" class="theme-btn" aria-label="Toggle theme">
        <span class="toggle-icon"></span>
        <span class="toggle-label">Light</span>
      </button>
    </div>
  </nav>

  <header class="hero">
    <div class="hero-inner">
      <div class="hero-eyebrow">Full-Stack Developer — Mobile</div>
      <h1 class="hero-heading">
        <span class="line">Enes</span>
        <span class="line">Kucukkaya</span>
        <span class="line outline">Portfolio.</span>
      </h1>
      <div class="hero-meta">
        <div class="meta-item">
          <span class="meta-num">5+</span>
          <span class="meta-label">Projects</span>
        </div>
        <div class="meta-item">
          <span class="meta-num">2</span>
          <span class="meta-label">Years Exp.</span>
        </div>
        <div class="meta-item">
          <span class="meta-num">∞</span>
          <span class="meta-label">Curiosity</span>
        </div>
      </div>
      <a href="#projects-section" class="hero-cta">View Work <span class="arrow">↓</span></a>
    </div>
    <div class="hero-index">
      <div class="index-line"><span>01</span><span>About</span></div>
      <div class="index-line"><span>02</span><span>Projects</span></div>
      <div class="index-line"><span>03</span><span>Contact</span></div>
    </div>
  </header>

  <section class="about-strip">
    <p>
      I build things that live on the internet — from elegant user interfaces
      to robust backend systems and data pipelines. Every line written with intent.
    </p>
  </section>

  <section id="projects-section" class="projects-section">
    <div class="section-header">
      <span class="section-num">02</span>
      <h2 class="section-title">Projects</h2>
    </div>

    <div id="projects-container" class="projects-grid">
      <!-- AJAX fills here -->
    </div>

    
  </section>

  <section id="contact-section" class="contact-section">
    <div class="section-header">
      <span class="section-num">03</span>
      <h2 class="section-title">Contact Me</h2>
    </div>

    <div class="contact-inner">
      <div class="contact-left">
        <p class="contact-intro">Have a project in mind?<br>Let's talk about it.</p>
        <div class="contact-links">
          <a href="mailto:eneskucukkaya0@gmail.com">eneskucukkaya0@gmail.com</a>
          <a href="https://github.com/EnesK-Dev" target="_blank">github.com/EnesK-Dev</a>
          <a href="https://www.linkedin.com/in/eneskucukkaya/" target="_blank">linkedin.com/in/eneskucukkaya</a>
        </div>
      </div>

      <form id="contactForm" class="contact-form">
        <div class="field">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Your name" required autocomplete="off">
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="your@email.com" required autocomplete="off">
        </div>
        <div class="field">
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Tell me about your project..." required rows="5"></textarea>
        </div>
        <button type="submit" class="submit-btn">
          <span>Send Message</span>
          <span class="btn-arrow">→</span>
        </button>
        <div id="response" class="form-response"></div>
      </form>
    </div>
  </section>

  <footer class="footer">
    <span class="footer-copy">© <span id="foot-year"></span> — Built with precision.</span>
    <span class="footer-badge">DN</span>
  </footer>
  <div class="fixed-image-container">
    <img src="death-note/ryuk_static.png" alt="Alt Sağ Resim" class="static-img">
    <img src="death-note/ryuk_active.gif" alt="Alt Sağ Resim" class="hover-gif">
  </div>

  <script src="script.js"></script>
  <script>
    document.getElementById('foot-year').textContent = new Date().getFullYear();
  </script>
</body>
</html>