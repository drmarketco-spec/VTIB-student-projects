<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us — VTIB Marketplace</title>

  <!-- Favicon -->
  <link href="img/favicon.png" rel="icon">

  <!-- Premium Fonts (matches site-wide font system) -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Syne:wght@700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS animations -->

  <!-- Shared site styles -->
  <link href="main.css" rel="stylesheet">

  <!-- ═══════════════════════════════════════════
       CONTACT PAGE — ADDITIONAL STYLES
       Styles for the page hero, info cards,
       contact form, and footer.
  ════════════════════════════════════════════ -->
  <style>

    /* ── Page hero banner ── */
    .page-hero {
      background: var(--em-dark);
      color: #fff;
      padding: 100px 0 80px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    /* Decorative radial glows */
    .page-hero::before {
      content: '';
      position: absolute; inset: 0; pointer-events: none;
      background:
        radial-gradient(ellipse 60% 70% at 90% 20%, rgba(34,160,107,.4) 0%, transparent 65%),
        radial-gradient(ellipse 40% 50% at 5%  80%, rgba(240,180,41,.1) 0%, transparent 60%);
    }
    .page-hero .container { position: relative; z-index: 1; }

    .page-hero h1 {
      font-family: var(--font-h);
      font-size: clamp(2.4rem, 5vw, 3.8rem);
      font-weight: 800; letter-spacing: -.04em;
      color: #fff; margin-bottom: 18px;
    }
    .page-hero h1 span {
      background: linear-gradient(90deg, #6ee7b7, #34d399 50%, var(--gold));
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .page-hero p {
      font-size: 1.05rem; color: rgba(255,255,255,.72);
      max-width: 500px; margin: 0 auto; line-height: 1.75;
    }

    /* ── Contact section wrapper ── */
    .contact-section {
      padding: 96px 0;
      background: var(--bg);
    }

    /* ── Info cards (location, email, phone, social) ── */
    .info-card {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: var(--r);
      padding: 28px 26px;
      box-shadow: var(--sh);
      transition: transform var(--ease), box-shadow var(--ease), border-color var(--ease);
    }
    .info-card:hover { transform: translateY(-5px); box-shadow: var(--sh-lg); border-color: var(--em); }

    /* Coloured icon circle */
    .info-icon {
      width: 48px; height: 48px; border-radius: 14px; flex-shrink: 0;
      background: linear-gradient(135deg, rgba(34,160,107,.14), rgba(34,160,107,.07));
      border: 1.5px solid rgba(34,160,107,.2);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.25rem; color: var(--em);
      transition: background .25s, transform .25s;
    }
    .info-card:hover .info-icon { background: var(--em); color: #fff; transform: scale(1.08); }

    .info-card h5 {
      font-family: var(--font-h); font-size: .95rem;
      font-weight: 800; color: var(--text); margin: 0 0 4px;
    }
    .info-card p, .info-card a {
      font-size: .88rem; color: var(--muted);
      margin: 0; line-height: 1.6; text-decoration: none;
    }
    .info-card a:hover { color: var(--em); }

    /* Social icons row */
    .contact-socials { display: flex; gap: 10px; margin-top: 4px; }
    .contact-socials a {
      width: 38px; height: 38px; border-radius: 10px;
      border: 1.5px solid var(--border);
      background: var(--bg);
      display: flex; align-items: center; justify-content: center;
      color: var(--muted); font-size: 1rem;
      transition: background .2s, border-color .2s, color .2s, transform .2s;
    }
    .contact-socials a:hover {
      background: var(--em); border-color: var(--em);
      color: #fff; transform: translateY(-3px);
    }

    /* ── Contact form card ── */
    .form-card {
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: var(--r);
      padding: 44px 40px;
      box-shadow: var(--sh);
    }
    @media (max-width: 576px) { .form-card { padding: 28px 20px; } }

    .form-card .form-label {
      font-family: var(--font-b); font-size: .82rem;
      font-weight: 700; color: var(--text);
      margin-bottom: 6px; display: block;
    }

    /* Custom inputs that respect design tokens + dark mode */
    .form-card .form-control {
      background: var(--bg);
      border: 1.5px solid var(--border);
      border-radius: 10px;
      color: var(--text);
      font-family: var(--font-b); font-size: .88rem;
      padding: 11px 14px;
      transition: border-color .2s, box-shadow .2s;
      box-shadow: none;
    }
    .form-card .form-control::placeholder { color: var(--muted); opacity: 1; }
    .form-card .form-control:focus {
      border-color: var(--em);
      box-shadow: 0 0 0 3px var(--em-glow);
      background: var(--surface);
      color: var(--text);
      outline: none;
    }
    .form-card textarea.form-control { resize: vertical; min-height: 150px; }

    /* Submit button */
    .btn-send {
      display: inline-flex; align-items: center; gap: 8px;
      background: linear-gradient(135deg, #34d399, var(--em));
      color: #fff; border: none;
      padding: 13px 32px; border-radius: 50px;
      font-family: var(--font-b); font-size: .95rem; font-weight: 700;
      cursor: pointer; box-shadow: 0 6px 24px var(--em-glow);
      transition: transform var(--ease), box-shadow var(--ease);
    }
    .btn-send:hover { transform: translateY(-3px); box-shadow: 0 10px 36px var(--em-glow); }

    /* Feedback alerts */
    .form-alert {
      display: none;
      padding: 14px 18px; border-radius: 10px; margin-top: 20px;
      font-family: var(--font-b); font-size: .88rem; font-weight: 600;
      display: none; align-items: center; gap: 10px;
    }
    .form-alert.success {
      background: rgba(34,160,107,.1);
      border: 1.5px solid rgba(34,160,107,.3);
      color: var(--em);
    }
    .form-alert.error {
      background: rgba(239,68,68,.08);
      border: 1.5px solid rgba(239,68,68,.25);
      color: #dc2626;
    }
    .form-alert.visible { display: flex; }

    /* ── Map embed wrapper ── */
    .map-wrap {
      border-radius: var(--r); overflow: hidden;
      box-shadow: var(--sh); border: 1.5px solid var(--border);
      margin-top: 64px;
    }
    .map-wrap iframe { display: block; width: 100%; height: 340px; border: none; }

    /* ── Footer ── */
    .site-footer {
      background: var(--em-dark);
      color: rgba(255,255,255,.7);
      padding: 64px 0 0;
      position: relative;
    }
    .site-footer::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(110,231,183,.3), transparent);
    }
    .site-footer .fn {
      font-family: var(--font-h); font-size: 1.5rem; font-weight: 800;
      color: #fff; letter-spacing: -.02em; display: block; margin-bottom: 10px;
    }
    .site-footer .tagline {
      font-size: .88rem; color: rgba(255,255,255,.5);
      max-width: 260px; line-height: 1.65;
    }
    .site-footer .footer-socials { display: flex; gap: 10px; margin-top: 20px; }
    .site-footer .footer-socials a {
      width: 36px; height: 36px; border-radius: 9px;
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.05);
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,.6); font-size: .95rem;
      transition: background .2s, border-color .2s, color .2s, transform .2s;
      text-decoration: none;
    }
    .site-footer .footer-socials a:hover {
      background: var(--em); border-color: var(--em);
      color: #fff; transform: translateY(-3px);
    }
    .site-footer .footer-col h5 {
      font-family: var(--font-h); font-size: .8rem; font-weight: 800;
      text-transform: uppercase; letter-spacing: .08em;
      color: rgba(255,255,255,.85); margin-bottom: 18px;
    }
    .site-footer .footer-col ul {
      list-style: none; padding: 0; margin: 0;
      display: flex; flex-direction: column; gap: 9px;
    }
    .site-footer .footer-col ul li a {
      font-size: .85rem; color: rgba(255,255,255,.5);
      transition: color .2s, padding-left .2s;
      display: inline-block; text-decoration: none;
    }
    .site-footer .footer-col ul li a:hover { color: #6ee7b7; padding-left: 4px; }
    .site-footer .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.07);
      padding: 20px 0; margin-top: 56px;
    }
    .site-footer .footer-bottom-inner {
      display: flex; align-items: center; justify-content: space-between;
      flex-wrap: wrap; gap: 10px;
    }
    .site-footer .footer-bottom p { font-size: .8rem; color: rgba(255,255,255,.35); margin: 0; }
    .site-footer .footer-bottom .credits { font-size: .78rem; color: rgba(255,255,255,.3); }
    .site-footer .footer-bottom .credits a { color: #6ee7b7; text-decoration: none; }




    #google_translate_element{
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.hidden {
    display: fixed !important;
}
.goog-te-gadget{
    background-color: transparent !important;
    border: none !important;
    font-size: 0 !important;
    color: transparent !important;
    padding: 0 !important;
    margin: 0 !important;
}

.goog-te-gadget-simple{
    background-color: transparent !important;
    border: none !important;
    font-size: 0 !important;
    color: transparent !important;
    padding: 0 !important;
    margin: 0 !important;
}

.translate-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

/* The Floating Icon */
.icon-circle {
    width: 50px;
    height: 50px;
    background: #4285F4; /* Google Blue */
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}

.icon-circle:active { transform: scale(0.9); }

/* The Dropdown Menu */
.lang-menu {
    display: none;
    position: absolute;
    top: 60px;
    right: 0;
    background: white;
    width: 200px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    overflow: hidden;
    border: 1px solid #eee;
}

.lang-menu.active { display: block; }

.menu-header {
    background: #f8f9fa;
    padding: 10px;
    font-size: 12px;
    font-weight: bold;
    color: #666;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.lang-list {
    list-style: none;
    margin: 0;
    padding: 0;
    max-height: 400px;
    overflow-y: auto;
}

.lang-list li a {
    display: block;
    padding: 12px 20px;
    color: #333;
    text-decoration: none;
    font-family: sans-serif;
    font-size: 15px;
    transition: background 0.2s;
}

.lang-list li a:hover { background: #f1f1f1; }

/* MOBILE RESPONSIVENESS */
@media (max-width: 480px) {
    .lang-menu {
        position: fixed;
        top: auto;
        bottom: 20px;
        left: 20px;
        right: 20px;
        width: auto;
        max-height: 70vh;
    }
}
  </style>
</head>
<body>

<!-- ═══════════════════════════════════════════
     HEADER / NAVBAR
════════════════════════════════════════════ -->
<header class="site-header" id="siteHeader">

  <!-- Top contact & search bar -->
  <div class="topbar">
    <div class="container topbar-inner">
      <div class="topbar-contacts">
        <a href="tel:+237650857613"><i class="bi bi-telephone-fill"></i>(+237) 650857613, 679318844</a>
        <a href="/cdn-cgi/l/email-protection#b6dfd8d0d9f6c0c2dfd498d5d9db"><i class="bi bi-envelope-fill"></i><span class="__cf_email__" data-cfemail="b5dcdbd3daf5c3c1dcd79bd6dad8">[email&#160;protected]</span></a>
      </div>
      <div class="topbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search for a student…">
      </div>
      <div id="google_translate_element" class="hidden"></div> <!-- Container Positioning -->
    </div>
  </div>

  <!-- Main navigation row -->
  <div class="container">
    <div class="navbar-row">

      <!-- Brand logo + name -->
      <a href="http://localhost/vtib-student-projects/index.php" class="brand">
        <div class="brand-logo">
          <img src="img/logo.png" alt="VTIB" onerror="this.style.display='none'">
          <span id="brandFallback" style="display:none">V</span>
        </div>
        <span class="brand-name">VTIB</span>
      </a>

      <!-- Desktop nav links -->
      <ul class="main-nav" id="mainNav">
        <li><a href="http://localhost/vtib-student-projects/index.php">Home</a></li>
          <li><a href="http://localhost/vtib-student-projects/vtib-about.php">About</a></li>
          <li><a href="http://localhost/vtib-student-projects/index.php#services">Services</a></li>
          <li><a href="http://localhost/vtib-student-projects/Project.php" class="active">Projects</a></li>
          <li><a href="http://localhost/vtib-student-projects/contact.php">Contact</a></li>
        <!-- CTA shown only inside the mobile drawer -->
        <li><a href="http://localhost/vtib-student-projects/Project.php" class="nav-cta mobile-cta"><i class="bi bi-grid-fill"></i> Browse Projects</a></li>
      </ul>

      <!-- CTA button (desktop only) -->
      <a href="http://localhost/vtib-student-projects/Project.php" class="nav-cta d-none d-lg-inline-flex">
        <i class="bi bi-grid-fill"></i> Browse Projects
      </a>

      <!-- Hamburger (mobile) -->
      <button class="nav-ham" id="navHam" aria-label="Open menu">
        <i class="bi bi-list"></i>
      </button>

    </div>
  </div>
</header>

<!-- Mobile nav overlay (closes menu when tapped) -->
<div class="nav-overlay d-none" id="navOverlay" onclick="closeNav()"></div>

<!-- Dark / light mode toggle (fixed floating button) -->
<button class="theme-float" id="themeToggle" aria-label="Toggle dark mode">🌙</button>

<!-- ═══════════════════════════════════════════
     PAGE HERO
════════════════════════════════════════════ -->
<section class="page-hero">
  <div class="container">
    <h1 data-aos="fade-up">Get In <span>Touch</span></h1>
    <p data-aos="fade-up" data-aos-delay="100">
      Have a question, a project idea, or just want to say hello?
      We'd love to hear from you.
    </p>
  </div>
</section>

<!-- ═══════════════════════════════════════════
     CONTACT SECTION
════════════════════════════════════════════ -->
<section class="contact-section" id="contact">
  <div class="container">
    <div class="row g-4 align-items-start">

      <!-- ── Left column: info cards ── -->
      <div class="col-lg-4 d-flex flex-column gap-3" data-aos="fade-right">

        <!-- Location -->
        <div class="info-card d-flex align-items-start gap-3">
          <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <div>
            <h5>Location</h5>
            <p>Ange Raphael, Douala<br>Cameroon</p>
          </div>
        </div>

        <!-- Email -->
        <div class="info-card d-flex align-items-start gap-3">
          <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
          <div>
            <h5>Email</h5>
            <a href="/cdn-cgi/l/email-protection#8de4e3ebe2cdfbf9e4efa3eee2e0"><span class="__cf_email__" data-cfemail="6d04030b022d1b19040f430e0200">[email&#160;protected]</span></a>
          </div>
        </div>

        <!-- Phone -->
        <div class="info-card d-flex align-items-start gap-3">
          <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
          <div>
            <h5>Phone</h5>
            <a href="tel:+237650857613">(+237) 650857613</a><br>
            <a href="tel:+237679318844">(+237) 679318844</a>
          </div>
        </div>

        <!-- Social links -->
        <div class="info-card">
          <h5 class="mb-3">Follow Us</h5>
          <div class="contact-socials">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Twitter / X"><i class="bi bi-twitter-x"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

      </div>

      <!-- ── Right column: contact form ── -->
      <div class="col-lg-8" data-aos="fade-left">
        <div class="form-card">

          <form id="contactForm" novalidate>
            <div class="row g-3">

              <!-- Name -->
              <div class="col-md-6">
                <label for="name" class="form-label">Your Name</label>
                <input
                  type="text" class="form-control" id="name"
                  placeholder="e.g. Jean Dupont" required>
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label for="email" class="form-label">Your Email</label>
                <input
                  type="email" class="form-control" id="email"
                  placeholder="you@example.com" required>
              </div>

              <!-- Subject -->
              <div class="col-12">
                <label for="subject" class="form-label">Subject</label>
                <input
                  type="text" class="form-control" id="subject"
                  placeholder="How can we help?" required>
              </div>

              <!-- Message -->
              <div class="col-12">
                <label for="message" class="form-label">Message</label>
                <textarea
                  class="form-control" id="message" rows="6"
                  placeholder="Write your message here…" required></textarea>
              </div>

              <!-- Submit -->
              <div class="col-12">
                <button type="submit" class="btn-send">
                  Send Message <i class="bi bi-send-fill"></i>
                </button>
              </div>

            </div>
          </form>

          <!-- Success feedback (shown on valid submit) -->
          <div id="successMessage" class="form-alert success" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <span><strong>Thank you!</strong> Your message has been sent. We'll get back to you soon.</span>
          </div>

          <!-- Error feedback (shown on failure) -->
          <div id="errorMessage" class="form-alert error" role="alert">
            <i class="bi bi-exclamation-circle-fill fs-5"></i>
            <span><strong>Oops!</strong> Something went wrong. Please try again.</span>
          </div>

        </div><!-- /.form-card -->
      </div>

    </div><!-- /.row -->

    <!-- ── Embedded map ── -->
    <div class="map-wrap" data-aos="fade-up" data-aos-delay="100">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127537.69487213!2d9.6539!3d4.0511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1061128be2e1fe6d%3A0x3f2c8b3e4f6e5c1a!2sDouala%2C%20Cameroon!5e0!3m2!1sen!2scm!4v1"
        allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="VTIB location in Douala, Cameroon">
      </iframe>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
<footer class="site-footer" id="footer">
  <div class="container">
    <div class="row gy-5">

      <!-- Brand column -->
      <div class="col-lg-4">
        <span class="fn">VTIB</span>
        <p class="tagline">Innovating the digital landscape with elegant solutions, empowering student talent and timeless design.</p>
        <div class="footer-socials">
          <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      <!-- Company links -->
      <div class="col-lg-2 col-md-4">
        <div class="footer-col">
          <h5>Company</h5>
          <ul>
            <li><a href="vtib-about.html">About Us</a></li>
            <li><a href="#">Our Team</a></li>
            <li><a href="#">Careers</a></li>
          </ul>
        </div>
      </div>

      <!-- Programs links -->
      <div class="col-lg-2 col-md-4">
        <div class="footer-col">
          <h5>Programs</h5>
          <ul>
            <li><a href="#">Software Engineering</a></li>
            <li><a href="#">Networking &amp; Security</a></li>
            <li><a href="#">Computer Graphics</a></li>
            <li><a href="#">And more…</a></li>
          </ul>
        </div>
      </div>

      <!-- Contact info -->
      <div class="col-lg-4 col-md-4">
        <div class="footer-col">
          <h5>Contact</h5>
          <ul>
            <li><a href="tel:+237679318844"><i class="bi bi-telephone-fill me-1"></i>679318844 / 695593749</a></li>
            <li><a href="tel:+237650857613"><i class="bi bi-telephone-fill me-1"></i>650857613 / 651857081</a></li>
            <li><a href="/cdn-cgi/l/email-protection#b6dfd8d0d9f6c0c2dfd498d5d9db"><i class="bi bi-envelope-fill me-1"></i><span class="__cf_email__" data-cfemail="f29b9c949db284869b90dc919d9f">[email&#160;protected]</span></a></li>
            <li><a href="#"><i class="bi bi-geo-alt-fill me-1"></i>Ange Raphael, Douala</a></li>
          </ul>
        </div>
      </div>

    </div><!-- /.row -->
  </div><!-- /.container -->

  <!-- Footer bottom bar -->
  <div class="footer-bottom">
    <div class="container">
      <div class="footer-bottom-inner">
        <p>© <strong style="color:rgba(255,255,255,.6)">VTIB Marketplace</strong>. All rights reserved.</p>
        <div class="credits">Designed by <a href="#">VTIB 2025/2026</a></div>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll-to-top button (shown after scrolling 120px) -->
<a href="#" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up-short"></i></a>

<!-- ═══════════════════════════════════════════
     VENDOR SCRIPTS
════════════════════════════════════════════ -->
<!-- AOS animations -->
<!-- AOS animations -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Bootstrap JS bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ═══════════════════════════════════════════
     PAGE SCRIPTS
════════════════════════════════════════════ -->
<script>
  /* ── AOS init ── */
  AOS.init({ duration: 700, easing: 'ease-out-cubic', once: true, offset: 0, initClassName: 'aos-init', animatedClassName: 'aos-animate' });

  /* ── Header shadow on scroll ── */
  const hdr = document.getElementById('siteHeader');
  window.addEventListener('scroll', () => {
    hdr.classList.toggle('scrolled', window.scrollY > 40);
  });

  /* ── Scroll-to-top button ── */
  const st = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => st.classList.toggle('show', window.scrollY > 120));
  st.addEventListener('click', e => { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); });

  /* ── Mobile nav open / close ── */
  const ham     = document.getElementById('navHam');
  const nav     = document.getElementById('mainNav');
  const overlay = document.getElementById('navOverlay');

  function openNav() {
    nav.classList.add('open');
    overlay.classList.remove('d-none');
    document.body.style.overflow = 'hidden';
    ham.querySelector('i').className = 'bi bi-x-lg';
  }
  function closeNav() {
    nav.classList.remove('open');
    overlay.classList.add('d-none');
    document.body.style.overflow = '';
    ham.querySelector('i').className = 'bi bi-list';
  }
  ham.addEventListener('click', () => nav.classList.contains('open') ? closeNav() : openNav());
  nav.querySelectorAll('a').forEach(a => a.addEventListener('click', closeNav));

  /* ── Brand logo image fallback ── */
  const logoImg = document.querySelector('.brand-logo img');
  if (logoImg) {
    logoImg.addEventListener('error', () => {
      logoImg.style.display = 'none';
      document.getElementById('brandFallback').style.display = 'block';
    });
  }

  /* ── Dark / light theme toggle ── */
  const themeBtn = document.getElementById('themeToggle');
  const root     = document.documentElement;
  if (localStorage.getItem('theme') === 'dark') {
    root.setAttribute('data-theme', 'dark');
    themeBtn.textContent = '☀️';
  }
  themeBtn.addEventListener('click', () => {
    const isDark = root.getAttribute('data-theme') === 'dark';
    if (isDark) {
      root.removeAttribute('data-theme');
      localStorage.setItem('theme', 'light');
      themeBtn.textContent = '🌙';
    } else {
      root.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
      themeBtn.textContent = '☀️';
    }
  });

  /* ── Contact form submit ── */
  document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const successEl = document.getElementById('successMessage');
    const errorEl   = document.getElementById('errorMessage');

    // Basic client-side validation
    const name    = document.getElementById('name').value.trim();
    const email   = document.getElementById('email').value.trim();
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();

    if (!name || !email || !subject || !message) {
      errorEl.classList.add('visible');
      successEl.classList.remove('visible');
      return;
    }

    // TODO: Replace this block with a real backend call
    successEl.classList.add('visible');
    errorEl.classList.remove('visible');
    this.reset();
  });

  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,zh-CN,es,hi,ar,fr,bn,pt,ru,ja',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    /*
     * TODO: Replace this block with a real backend call, e.g.:
     *
     * fetch('/api/contact', {
     *   method: 'POST',
     *   headers: { 'Content-Type': 'applic