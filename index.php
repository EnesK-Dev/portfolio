<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>My Digital Identity</h2>
        <button id="theme-toggle">Toggle Dark Mode</button>
    </nav>

    <header>
        <h1>Yazılım Mühendisliği Portfolyosu</h1>
        <p>Full-Stack Developer | Mobile & Data Specialist</p>
    </header>

    <section id="projects-section">
        <h2>Projects</h2>
        <div id="projects-container">
            <!-- AJAX burayı dolduracak -->
        </div>
    </section>

    <section id="contact-section">
        <h2>Contact Me</h2>
        <form id="contactForm">
            <input type="text" id="name" name="name" placeholder="Name" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <textarea id="message" name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <div id="response"></div>
    </section>

    <script src="script.js"></script>
</body>
</html>