document.addEventListener('DOMContentLoaded', () => {
    // 1. Projeleri Veritabanından AJAX ile Çekme
    fetch('get_projects.php')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('projects-container');
            container.innerHTML = data.map(p => `
                <div class="project-card">
                    <h3>${p.title}</h3>
                    <p>${p.description}</p>
                </div>
            `).join('');
        });

    // 2. Form Validation & AJAX Submission
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('save_message.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            document.getElementById('response').innerText = data;
            this.reset();
        });
    });

    // 3. Dark Mode Toggle
    document.getElementById('theme-toggle').addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });
});