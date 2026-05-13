(function () {
    'use strict';
  
    /* ── Theme Toggle ─────────────────────────────────── */
    const html = document.documentElement;
    const themeBtn = document.getElementById('theme-toggle');
    const toggleLabel = themeBtn && themeBtn.querySelector('.toggle-label');
  
    const DARK = 'dark';
    const LIGHT = 'light';
  
    const LIGHT_THEME_VARS = {
      '--bg': '#f5f5f5',
      '--bg-alt': '#ebebeb',
      '--bg-card': '#ffffff',
      '--border': '#d8d8d8',
      '--border-mid': '#c0c0c0',
      '--text-1': '#0c0c0c',
      '--text-2': '#555555',
      '--text-3': '#aaaaaa',
      '--accent': '#0c0c0c',
      '--accent-inv': '#f5f5f5',
    };
    const LIGHT_VAR_KEYS = Object.keys(LIGHT_THEME_VARS);
  
    function normalizeTheme(value) {
      if (value == null || value === '') return DARK;
      const v = String(value).trim().toLowerCase();
      if (v === LIGHT) return LIGHT;
      if (v === DARK) return DARK;
      return DARK;
    }
  
    function applyTheme(theme) {
      theme = normalizeTheme(theme);
      html.setAttribute('data-theme', theme);
      if (theme === LIGHT) {
        html.style.colorScheme = 'light';
        for (let i = 0; i < LIGHT_VAR_KEYS.length; i++) {
          const key = LIGHT_VAR_KEYS[i];
          html.style.setProperty(key, LIGHT_THEME_VARS[key]);
        }
      } else {
        html.style.colorScheme = 'dark';
        for (let i = 0; i < LIGHT_VAR_KEYS.length; i++) {
          html.style.removeProperty(LIGHT_VAR_KEYS[i]);
        }
      }
      if (toggleLabel) {
        toggleLabel.textContent = theme === DARK ? 'Light' : 'Dark';
      }
      try {
        localStorage.setItem('portfolio-theme', theme);
      } catch (_) {}
    }
  
    (function initTheme() {
      let saved = DARK;
      try {
        saved = localStorage.getItem('portfolio-theme') || DARK;
      } catch (_) {}
      applyTheme(normalizeTheme(saved));
    })();
  
    if (themeBtn) {
      themeBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const current = normalizeTheme(html.getAttribute('data-theme'));
        applyTheme(current === DARK ? LIGHT : DARK);
      });
    }
  
    /* ── Projects AJAX ────────────────────────────────── */
    const projectsContainer = document.getElementById('projects-container');
  
    function escapeHtml(str) {
      if (str == null) return '';
      const div = document.createElement('div');
      div.textContent = String(str);
      return div.innerHTML;
    }
  
    function renderProjectCard(project, index) {
      const num = String(index + 1).padStart(3, '0');
      const rawTechs = project.technologies || project.tech || [];
      const techList = Array.isArray(rawTechs) ? rawTechs : [];
      const techs = techList.map((t) => `<span>${escapeHtml(t)}</span>`).join('');
  
      const title = escapeHtml(project.title || project.name || '');
      const desc = escapeHtml(project.description || '');
      const category = escapeHtml(project.category || project.type || 'Project');
      const rawUrl = project.url || project.link || '#';
      const href = typeof rawUrl === 'string' && /^(https?:|mailto:|#)/i.test(rawUrl.trim())
        ? rawUrl.trim()
        : '#';
  
      return `
        <article class="project-card${index === 1 ? ' card-featured' : ''}">
          <div class="card-head">
            <span class="card-num">${num}</span>
            <span class="card-tag">${category}</span>
          </div>
          <h3 class="card-title">${title}</h3>
          <p class="card-desc">${desc}</p>
          <div class="card-tech">${techs}</div>
          <a href="${escapeHtml(href)}" class="card-link" target="_blank" rel="noopener noreferrer">
            View Case <span>→</span>
          </a>
        </article>`;
    }
  
    function loadProjects() {
      if (!projectsContainer) return;
  
      fetch('get_projects.php')
        .then(function (res) {
          if (!res.ok) throw new Error('Network response was not ok');
          return res.json();
        })
        .then(function (data) {
          if (!Array.isArray(data) || data.length === 0) return;
          projectsContainer.innerHTML = data.map(renderProjectCard).join('');
        })
        .catch(function (err) {
          console.warn('Projects could not be loaded via AJAX:', err.message);
        });
    }
  
    loadProjects();
  
    /* ── Contact Form AJAX ────────────────────────────── */
    const contactForm = document.getElementById('contactForm');
    const responseEl = document.getElementById('response');
  
    function setResponse(msg, isError) {
      if (!responseEl) return;
      responseEl.textContent = msg;
      responseEl.style.color = isError ? '#cc4444' : 'inherit';
      responseEl.style.opacity = '1';
    }
  
    function clearResponse() {
      if (!responseEl) return;
      responseEl.textContent = '';
    }
  
    if (contactForm) {
      contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        clearResponse();
  
        const btn = contactForm.querySelector('.submit-btn');
        const span = btn && btn.querySelector('span');
        if (span) span.textContent = 'Sending…';
        if (btn) btn.disabled = true;
  
        const body = new URLSearchParams({
          name: document.getElementById('name').value.trim(),
          email: document.getElementById('email').value.trim(),
          message: document.getElementById('message').value.trim(),
        });
  
        fetch('save_message.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: body.toString(),
        })
          .then(function (res) {
            if (!res.ok) throw new Error('Server error ' + res.status);
            return res.text();
          })
          .then(function (text) {
            setResponse(text || 'Message sent successfully.', false);
            contactForm.reset();
          })
          .catch(function (err) {
            setResponse('Something went wrong. Please try again.', true);
            console.error('Contact form error:', err);
          })
          .finally(function () {
            if (span) span.textContent = 'Send Message';
            if (btn) btn.disabled = false;
          });
      });
    }
  
    /* ── Smooth scroll for anchor links ──────────────── */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (!href || href === '#') return;
        const target = document.querySelector(href);
        if (!target) return;
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  
  })();