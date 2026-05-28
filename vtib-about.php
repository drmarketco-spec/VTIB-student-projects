<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us — VTIB Marketplace</title>

  <!-- Favicon -->
  <link href="img/favicon.png" rel="icon">

  <!-- Premium Fonts (matches site-wide font system) -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Syne:wght@700;800&display=swap"
    rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS animations -->

  <!-- Shared site styles -->
  <link href="main.css" rel="stylesheet">

  <!-- ═══════════════════════════════════════════
       ABOUT PAGE — ADDITIONAL STYLES
       Styles for the about hero, stats, story,
       mission/vision, values, team, and CTA sections.
  ════════════════════════════════════════════ -->
  <style>
    /* ── About hero banner ── */
    .about-hero {
      background: linear-gradient(135deg, var(--em-dark) 0%, var(--em) 100%);
      padding: 120px 0 100px;
      color: #fff;
      position: relative;
      overflow: hidden;
    }

    /* Decorative blurred circles in background */
    .about-hero::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -15%;
      width: 600px;
      height: 600px;
      background: rgba(255, 255, 255, .08);
      border-radius: 50%;
    }

    .about-hero::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: -10%;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, .05);
      border-radius: 50%;
    }

    .about-hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    .about-hero h1 {
      font-family: var(--font-h);
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 800;
      letter-spacing: -.04em;
      margin-bottom: 24px;
      color: #fff;
    }

    .about-hero p {
      font-size: clamp(1rem, 2vw, 1.25rem);
      opacity: .9;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.75;
      color: rgba(255, 255, 255, .85);
    }

    /* ── Stats strip (overlaps hero bottom) ── */
    .stats-section {
      background: var(--bg);
      padding: 80px 0;
      margin-top: -60px;
      position: relative;
      z-index: 2;
    }

    .stat-box {
      background: var(--surface);
      padding: 46px 28px;
      border-radius: var(--r);
      text-align: center;
      box-shadow: var(--sh);
      border: 1px solid var(--border);
      transition: transform var(--ease), box-shadow var(--ease);
    }

    .stat-box:hover {
      transform: translateY(-8px);
      box-shadow: var(--sh-lg);
    }

    .stat-number {
      font-family: var(--font-h);
      font-size: 3.2rem;
      font-weight: 800;
      color: var(--em);
      display: block;
      margin-bottom: 10px;
    }

    .stat-label {
      font-size: 1rem;
      color: var(--muted);
      font-weight: 600;
    }

    /* ── Our story section ── */
    .story-section {
      padding: 100px 0;
      background: var(--surface);
    }

    .story-content {
      max-width: 860px;
      margin: 0 auto;
    }

    .section-eyebrow {
      color: var(--em);
      font-family: var(--font-b);
      font-weight: 700;
      font-size: .75rem;
      text-transform: uppercase;
      letter-spacing: .12em;
      margin-bottom: 14px;
      display: block;
    }

    .section-title {
      font-family: var(--font-h);
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 800;
      letter-spacing: -.03em;
      margin-bottom: 36px;
      color: var(--text);
    }

    .section-title .highlight {
      background: linear-gradient(90deg, var(--em), #34d399);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .story-text {
      font-size: 1.08rem;
      line-height: 1.9;
      color: var(--muted);
      margin-bottom: 22px;
    }

    /* Pull-quote block */
    .story-highlight {
      background: var(--bg-2);
      padding: 36px 40px;
      border-left: 4px solid var(--em);
      margin: 40px 0;
      border-radius: 0 var(--r) var(--r) 0;
    }

    .story-highlight p {
      margin: 0;
      font-size: 1.2rem;
      font-style: italic;
      color: var(--em-dark);
      font-weight: 600;
      line-height: 1.8;
    }

    [data-theme="dark"] .story-highlight p {
      color: #6ee7b7;
    }

    /* ── Mission & vision cards ── */
    .mission-vision-section {
      padding: 100px 0;
      background: var(--bg);
    }

    .mission-box,
    .vision-box {
      background: var(--surface);
      padding: 56px 44px;
      border-radius: var(--r);
      height: 100%;
      border: 2px solid var(--em);
      box-shadow: var(--sh-lg);
      transition: transform var(--ease), box-shadow var(--ease);
    }

    .mission-box:hover,
    .vision-box:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 70px rgba(34, 160, 107, .2);
    }

    /* Vision card uses gold accent */
    .vision-box {
      border-color: var(--gold);
    }

    .vision-box:hover {
      box-shadow: 0 25px 70px rgba(240, 180, 41, .2);
    }

    .mission-icon,
    .vision-icon {
      font-size: 3.5rem;
      margin-bottom: 22px;
      display: block;
    }

    .mission-box h3,
    .vision-box h3 {
      font-family: var(--font-h);
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 20px;
      color: var(--text);
    }

    .mission-box p,
    .vision-box p {
      font-size: 1rem;
      line-height: 1.8;
      color: var(--muted);
      margin-bottom: 16px;
    }

    /* ── Core values grid ── */
    .values-section {
      padding: 100px 0;
      background: var(--surface);
    }

    .value-card {
      background: var(--bg-2);
      padding: 46px 36px;
      border-radius: var(--r);
      text-align: center;
      height: 100%;
      box-shadow: var(--sh);
      border: 1px solid var(--border);
      transition: transform var(--ease), box-shadow var(--ease), border-color var(--ease);
    }

    .value-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--sh-lg);
      border-color: var(--em);
    }

    .value-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--em), var(--em-mid));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      font-size: 2rem;
      color: #fff;
      box-shadow: 0 8px 24px var(--em-glow);
    }

    .value-card h4 {
      font-family: var(--font-h);
      font-size: 1.3rem;
      font-weight: 800;
      margin-bottom: 14px;
      color: var(--text);
    }

    .value-card p {
      color: var(--muted);
      line-height: 1.75;
      font-size: .95rem;
      margin: 0;
    }

    /* ── Team section ── */
    .team-section {
      padding: 100px 0;
      background: var(--bg);
    }

    .team-member {
      text-align: center;
    }

    /* Avatar circle with initials fallback */
    .team-photo {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      margin: 0 auto 22px;
      background: linear-gradient(135deg, var(--em-dark), var(--em));
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: var(--font-h);
      font-size: 4.5rem;
      font-weight: 800;
      color: #fff;
      box-shadow: 0 12px 36px rgba(34, 160, 107, .25);
      border: 4px solid var(--surface);
    }

    .team-member h4 {
      font-family: var(--font-h);
      font-size: 1.4rem;
      font-weight: 800;
      margin-bottom: 6px;
      color: var(--text);
    }

    .team-role {
      color: var(--em);
      font-weight: 700;
      margin-bottom: 10px;
      font-size: .9rem;
    }

    .team-bio {
      color: var(--muted);
      max-width: 300px;
      margin: 0 auto;
      line-height: 1.7;
      font-size: .9rem;
    }

    /* ── CTA banner ── */
    .cta-section {
      background: linear-gradient(135deg, var(--em-dark) 0%, var(--em) 100%);
      padding: 100px 0;
      color: #fff;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: -30%;
      left: -10%;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, .05);
      border-radius: 50%;
    }

    .cta-section .container {
      position: relative;
      z-index: 1;
    }

    .cta-section h2 {
      font-family: var(--font-h);
      font-size: clamp(2rem, 4vw, 3rem);
      font-weight: 800;
      margin-bottom: 18px;
      color: #fff;
    }

    .cta-section p {
      font-size: 1.15rem;
      margin-bottom: 36px;
      opacity: .9;
      max-width: 660px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.7;
    }

    .cta-btn {
      background: #fff;
      color: var(--em);
      padding: 16px 46px;
      border-radius: 50px;
      font-family: var(--font-b);
      font-weight: 700;
      font-size: 1rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: transform var(--ease), box-shadow var(--ease);
      box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
    }

    .cta-btn:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, .3);
      color: var(--em);
    }

    /* ── Footer ── */
    .site-footer {
      background: var(--em-dark);
      color: rgba(255, 255, 255, .7);
      padding: 64px 0 0;
      position: relative;
    }

    .site-footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(110, 231, 183, .3), transparent);
    }

    .site-footer .fn {
      font-family: var(--font-h);
      font-size: 1.5rem;
      font-weight: 800;
      color: #fff;
      letter-spacing: -.02em;
      display: block;
      margin-bottom: 10px;
    }

    .site-footer .tagline {
      font-size: .88rem;
      color: rgba(255, 255, 255, .5);
      max-width: 260px;
      line-height: 1.65;
    }

    .site-footer .footer-socials {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .site-footer .footer-socials a {
      width: 36px;
      height: 36px;
      border-radius: 9px;
      border: 1px solid rgba(255, 255, 255, .12);
      background: rgba(255, 255, 255, .05);
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(255, 255, 255, .6);
      font-size: .95rem;
      transition: background .2s, border-color .2s, color .2s, transform .2s;
      text-decoration: none;
    }

    .site-footer .footer-socials a:hover {
      background: var(--em);
      border-color: var(--em);
      color: #fff;
      transform: translateY(-3px);
    }

    .site-footer .footer-col h5 {
      font-family: var(--font-h);
      font-size: .8rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: rgba(255, 255, 255, .85);
      margin-bottom: 18px;
    }

    .site-footer .footer-col ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 9px;
    }

    .site-footer .footer-col ul li a {
      font-size: .85rem;
      color: rgba(255, 255, 255, .5);
      transition: color .2s, padding-left .2s;
      display: inline-block;
      text-decoration: none;
    }

    .site-footer .footer-col ul li a:hover {
      color: #6ee7b7;
      padding-left: 4px;
    }

    .site-footer .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, .07);
      padding: 20px 0;
      margin-top: 56px;
    }

    .site-footer .footer-bottom-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
    }

    .site-footer .footer-bottom p {
      font-size: .8rem;
      color: rgba(255, 255, 255, .35);
      margin: 0;
    }

    .site-footer .footer-bottom .credits {
      font-size: .78rem;
      color: rgba(255, 255, 255, .3);
    }

    .site-footer .footer-bottom .credits a {
      color: #6ee7b7;
      text-decoration: none;
    }

    /* ── Mobile responsive adjustments ── */
    @media (max-width: 768px) {
      .about-hero {
        padding: 80px 0 60px;
      }

      .stat-number {
        font-size: 2.6rem;
      }

      .mission-box,
      .vision-box {
        margin-bottom: 24px;
      }

      .team-photo {
        width: 160px;
        height: 160px;
        font-size: 3.5rem;
      }
    }


    #google_translate_element {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .hidden {
      display: fixed !important;
    }

    .goog-te-gadget {
      background-color: transparent !important;
      border: none !important;
      font-size: 0 !important;
      color: transparent !important;
      padding: 0 !important;
      margin: 0 !important;
    }

    .goog-te-gadget-simple {
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
      background: #4285F4;
      /* Google Blue */
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 24px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s;
    }

    .icon-circle:active {
      transform: scale(0.9);
    }

    /* The Dropdown Menu */
    .lang-menu {
      display: none;
      position: absolute;
      top: 60px;
      right: 0;
      background: white;
      width: 200px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      border: 1px solid #eee;
    }

    .lang-menu.active {
      display: block;
    }

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

    .lang-list li a:hover {
      background: #f1f1f1;
    }

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
          <a href="/cdn-cgi/l/email-protection#9df4f3fbf2ddebe9f4ffb3fef2f0"><i class="bi bi-envelope-fill"></i><span
              class="__cf_email__" data-cfemail="1b72757d745b6d6f727935787476">scolarite@vtib-eportal.net</span></a>
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
        <a href="index.html" class="brand">
          <div class="brand-logo">
            <img src="img/logo.png" alt="VTIB" onerror="this.style.display='none'">
            <span id="brandFallback" style="display:none">V</span>
          </div>
          <span class="brand-name">VTIB</span>
        </a>

        <!-- Desktop nav links -->
        <ul class="main-nav" id="mainNav">
          <li><a href="http://localhost/vtib-student-projects/index.php">Home</a></li>
          <li><a href="http://localhost/vtib-student-projects/vtib-about.php" class="active">About</a></li>
          <li><a href="http://localhost/vtib-student-projects/Project.php">Projects</a></li>
          <li><a href="http://localhost/vtib-student-projects/contact.php">Contact</a></li>
          <!-- CTA shown only inside the mobile drawer -->
          <li><a href="http://localhost/vtib-student-projects/Project.php" class="nav-cta mobile-cta">
              Browse Projects</a></li>
          <li><a href="http://localhost/vtib-student-projects/login.php" class="nav-cta mobile-cta">
              Login</a></li>
        </ul>

        <!-- CTA button (desktop only) -->
        <!-- <a href="http://localhost/vtib-student-projects/Project.php" class="nav-cta d-none d-lg-inline-flex">
        <i class="bi bi-grid-fill"></i> Browse Projects
      </a> -->

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
     ABOUT HERO
════════════════════════════════════════════ -->
  <section class="about-hero">
    <div class="container">
      <div class="about-hero-content">
        <h1 data-aos="fade-up">About VTIB Marketplace</h1>
        <p data-aos="fade-up" data-aos-delay="100">
          Empowering students to showcase their creativity and entrepreneurial skills by
          sharing projects for sale. Join a community of talented students turning ideas into reality.
        </p>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     STATS STRIP
════════════════════════════════════════════ -->
  <section class="stats-section">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="0">
          <div class="stat-box">
            <span class="stat-number">500+</span>
            <span class="stat-label">Student Projects</span>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
          <div class="stat-box">
            <span class="stat-number">1,200+</span>
            <span class="stat-label">Active Creators</span>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
          <div class="stat-box">
            <span class="stat-number">50+</span>
            <span class="stat-label">Schools</span>
          </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
          <div class="stat-box">
            <span class="stat-number">96%</span>
            <span class="stat-label">Satisfaction</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     OUR STORY
════════════════════════════════════════════ -->
  <section class="story-section">
    <div class="container">
      <div class="story-content" data-aos="fade-up">
        <span class="section-eyebrow">Our Journey</span>
        <h2 class="section-title">The <span class="highlight">VTIB Story</span></h2>

        <p class="story-text">
          VTIB Marketplace was born from a simple yet powerful observation: students create
          incredible projects every semester, but these innovations often remain hidden in
          computer folders or forgotten after submission. We saw talented developers, designers,
          and creators with real-world solutions that deserved to be seen, shared, and rewarded.
        </p>

        <p class="story-text">
          Whether you want to explore innovative ideas or share your own, our platform is the
          perfect place for student creators. We provide a supportive space where students can
          learn, collaborate, and grow. From tech innovations to artistic creations, we believe
          every idea has the potential to make an impact.
        </p>

        <!-- Pull quote -->
        <div class="story-highlight">
          <p>
            "By connecting creators with a wider audience, we help transform passion into opportunity.
            Together, we are building a future where student talent is recognised and rewarded."
          </p>
        </div>

        <p class="story-text">
          Our mission is to provide a supportive space where students can learn, collaborate, and
          grow. Today, VTIB Marketplace serves over 1,200 students across 50+ schools, creating a
          thriving ecosystem where creativity meets opportunity.
        </p>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     MISSION & VISION
════════════════════════════════════════════ -->
  <section class="mission-vision-section">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">What Drives Us</span>
        <h2 class="section-title">Mission &amp; <span class="highlight">Vision</span></h2>
      </div>
      <div class="row g-4">

        <!-- Mission -->
        <div class="col-md-6" data-aos="fade-right">
          <div class="mission-box">
            <span class="mission-icon">🎯</span>
            <h3>Our Mission</h3>
            <p>
              To empower students to showcase their creativity and entrepreneurial skills by
              providing a platform where they can share projects for sale and connect with a
              wider audience.
            </p>
            <p>
              We provide the tools, platform, and community for students to transform their
              academic projects into real-world opportunities — turning passion into profit
              and ideas into impact.
            </p>
          </div>
        </div>

        <!-- Vision -->
        <div class="col-md-6" data-aos="fade-left">
          <div class="vision-box">
            <span class="vision-icon">🚀</span>
            <h3>Our Vision</h3>
            <p>
              To build a future where student talent is universally recognised and rewarded,
              creating the world's largest student-driven marketplace for innovative projects
              and creative solutions.
            </p>
            <p>
              We envision a community of talented students turning ideas into reality, where
              every creator has the opportunity to monetise their skills and every innovation
              finds its audience.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     CORE VALUES
════════════════════════════════════════════ -->
  <section class="values-section">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">What We Stand For</span>
        <h2 class="section-title">Our Core <span class="highlight">Values</span></h2>
      </div>
      <div class="row g-4">

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
            <h4>Innovation First</h4>
            <p>We celebrate creativity and encourage students to push boundaries, experiment fearlessly, and create
              solutions that make a difference.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-people"></i></div>
            <h4>Community Driven</h4>
            <p>A platform built by students, for students. Our community thrives on collaboration, mutual support, and
              collective success.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-shield-check"></i></div>
            <h4>Trust &amp; Integrity</h4>
            <p>We maintain the highest standards of honesty, transparency, and fairness in all transactions and
              interactions.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-trophy"></i></div>
            <h4>Quality Excellence</h4>
            <p>We strive for quality in every project, every interaction, and every feature we build on our platform.
            </p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-arrow-up-circle"></i></div>
            <h4>Growth Mindset</h4>
            <p>We believe in continuous learning, embracing challenges, and turning every experience into an opportunity
              for growth.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="value-card">
            <div class="value-icon"><i class="bi bi-heart"></i></div>
            <h4>Student-First</h4>
            <p>Every decision we make prioritises the needs, success, and wellbeing of our student creators and buyers.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     TEAM
════════════════════════════════════════════ -->
  <section class="team-section">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <span class="section-eyebrow">The People Behind VTIB</span>
        <h2 class="section-title">Meet Our <span class="highlight">Team</span></h2>
      </div>
      <div class="row justify-content-center g-4">

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
          <div class="team-member">
            <div class="team-photo">DR</div>
            <h4>DANIEL ROY</h4>
            <div class="team-role">Founder &amp; CEO</div>
            <p class="team-bio">Computer Science student passionate about building platforms that empower student
              creators.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="team-member">
            <div class="team-photo">SP</div>
            <h4>SAMA PRINCEWILL</h4>
            <div class="team-role">Co-Founder &amp; CTO</div>
            <p class="team-bio">Full-stack developer dedicated to creating inclusive tech communities for students.</p>
          </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="team-member">
            <div class="team-photo">KE</div>
            <h4>KENTSA STYVE</h4>
            <div class="team-role">Community Manager</div>
            <p class="team-bio">Passionate about building connections and fostering collaboration among student
              innovators.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     CALL TO ACTION
════════════════════════════════════════════ -->
  <section class="cta-section">
    <div class="container" data-aos="zoom-in">
      <h2>Ready to Join Our Community?</h2>
      <p>
        Whether you're a creator looking to showcase your work or exploring innovative student
        projects, VTIB Marketplace is your platform to transform ideas into reality.
      </p>
      <a href="Project.html" class="cta-btn">
        Explore Projects Now <i class="bi bi-arrow-right"></i>
      </a>
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
          <p class="tagline">Innovating the digital landscape with elegant solutions, empowering student talent and
            timeless design.</p>
          <div class="footer-socials">
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <!-- Quick links -->
        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>Quick Links</h5>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="vtib-about.html">About</a></li>
              <li><a href="Project.html">Projects</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
        </div>

        <!-- Student resources -->
        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>For Students</h5>
            <ul>
              <li><a href="#">Upload Project</a></li>
              <li><a href="#">Seller Dashboard</a></li>
              <li><a href="#">Guidelines</a></li>
              <li><a href="#">FAQ</a></li>
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
              <li><a href="/cdn-cgi/l/email-protection#4c25222a230c3a38252e622f2321"><i
                    class="bi bi-envelope-fill me-1"></i><span class="__cf_email__"
                    data-cfemail="650c0b030a2513110c074b060a08">scolarite@vtib-eportal.net</span></a></li>
              <li><a href="#"><i class="bi bi-geo-alt-fill me-1"></i>Ange Raphael, Douala</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>

    <!-- Footer bottom bar -->
    <div class="footer-bottom">
      <div class="container">
        <div class="footer-bottom-inner">
          <p>© <strong style="color:rgba(255,255,255,.6)">VTIB Marketplace</strong>. Built with ❤️ by students, for
            students.</p>
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
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <!-- Bootstrap JS bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ═══════════════════════════════════════════
     PAGE SCRIPTS
════════════════════════════════════════════ -->
  <script>
    /* ── AOS init ──
       offset:0 ensures elements already in the viewport on page load
       are animated immediately rather than staying invisible. */
    AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true, offset: 0, initClassName: 'aos-init', animatedClassName: 'aos-animate' });

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
    const ham = document.getElementById('navHam');
    const nav = document.getElementById('mainNav');
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
    const root = document.documentElement;
    if (localStorage.getItem('theme') === 'dark') {
      root.setAttribute('data-theme', 'dark');
      themeBtn.textContent = '☀️';
    }
    themeBtn.addEventListener('click', () => {
      const isDark = root.getAttribute('data-theme') === 'dark';
      root.setAttribute('data-theme', isDark ? 'light' : 'dark');
      themeBtn.textContent = isDark ? '🌙' : '☀️';
    });
  </script>

  <script type="text/javascript"
    src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,zh-CN,es,hi,ar,fr,bn,pt,ru,ja',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
  </script>