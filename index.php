<?php
require_once 'config/db.php';

$stmt = $pdo->query("
    SELECT p.*, s.name AS full_name
    FROM projects p
    JOIN students s ON s.id = p.student_id
    ORDER BY p.created_at DESC
    LIMIT 6
");

$featured_projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VTIB Marketplace — Student Innovation Hub</title>
  <link href="img/favicon.png" rel="icon">

  <!-- Premium Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Syne:wght@700;800&display=swap"
    rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS -->

  <!-- Page Styles -->
  <link rel="stylesheet" href="main.css">
</head>

<body>

  <!-- ═══════════════════════════════════════════
     HEADER / NAVBAR
════════════════════════════════════════════ -->
  <header class="site-header" id="siteHeader">

    <!-- Top bar -->
    <div class="topbar">
      <div class="container topbar-inner">
        <div class="topbar-contacts">
          <a href="tel:+237650857613"><i class="bi bi-telephone-fill"></i>(+237) 650857613, 679318844</a>
          <a href="/cdn-cgi/l/email-protection#670e0901082711130e054904080a"><i class="bi bi-envelope-fill"></i><span
              class="__cf_email__" data-cfemail="a2cbccc4cde2d4d6cbc08cc1cdcf">[email&#160;protected]</span></a>
        </div>
        <div class="topbar-search">
          <i class="bi bi-search"></i>
          <input type="text" placeholder="Search for a student…">

        </div>
        <div id="google_translate_element" class="hidden"></div> <!-- Container Positioning -->
      </div>
    </div>

    <!-- Main nav -->
    <div class="container">
      <div class="navbar-row">
        <a href="index.php" class="brand">
          <div class="brand-logo">
            <img src="img/logo.png" alt="VTIB" onerror="this.style.display='none'">
            <span id="brandFallback" class="hidden">V</span>
          </div>
          <span class="brand-name">VTIB</span>
        </a>

        <ul class="main-nav" id="mainNav">
          <li><a href="http://localhost/vtib-student-projects/index.php" class="active">Home</a></li>
          <li><a href="http://localhost/vtib-student-projects/vtib-about.php">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="http://localhost/vtib-student-projects/contact.php">Contact</a></li>
          <!-- CTA shown only inside the mobile drawer -->
          <li><a href="http://localhost/vtib-student-projects/Project.php" class="nav-cta mobile-cta">
              Browse Projects</a></li>
          <li><a href="http://localhost/vtib-student-projects/login.php" class="nav-cta mobile-cta">
              Login</a></li>

        </ul>

        <!-- Desktop CTA (hidden on mobile via CSS) -->
        <!-- <a href="login.php" class="nav-cta d-none d-lg-inline-flex">
        <i class="bi bi-grid-fill"></i> Browse Projects
      </a> -->

        <!-- Hamburger toggle (mobile only) -->
        <button class="nav-ham" id="navHam" aria-label="Open menu">
          <i class="bi bi-list"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile nav overlay -->
  <div class="nav-overlay d-none" id="navOverlay" onclick="closeNav()"></div>

  <!-- Theme toggle -->
  <button class="theme-float" id="themeToggle" aria-label="Toggle dark mode">🌙</button>

  <!-- ═══════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
  <section class="hero" id="home">
    <div class="hero-bg">
      <div class="photo"></div>
      <div class="mesh"></div>
      <div class="grain"></div>
    </div>

    <!-- Decorative rings (hidden on mobile) -->
    <div class="hero-rings">
      <div class="ring ring-a"></div>
      <div class="ring ring-b"></div>
      <div class="ring ring-c"></div>
      <div class="ring-dot"></div>
    </div>

    <!-- Floating info badge cards (hidden on mobile) -->
    <div class="hero-badge hero-badge-1">
      <div class="badge-icon">🚀</div>
      <div>
        <div class="badge-subtitle">Latest</div>New Projects Weekly
      </div>
    </div>
    <div class="hero-badge hero-badge-2">
      <div class="badge-icon">⭐</div>
      <div>
        <div class="badge-subtitle">Rating</div>4.9 / 5.0 Avg
      </div>
    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="hero-eyebrow">
            <span class="pulse-dot"></span>
            VTIB Student Innovation Platform
          </div>
          <h1 class="hero-title">
            Discover VTIB's<br>
            <span class="line-2">Student-Built Projects</span>
          </h1>
          <p class="hero-desc">
            A platform where students showcase, sell, and get rewarded for their
            real-world projects. Join a thriving community of creators and innovators.
          </p>
          <div class="hero-actions">
            <a href="Project.html" class="btn-hero-primary">
              <i class="bi bi-grid-fill"></i> Browse Projects
            </a>
            <a href="#about" class="btn-hero-ghost">
              <i class="bi bi-play-circle"></i> Learn More
            </a>
          </div>
          <div class="hero-stats">
            <div class="hstat">
              <span class="n">120<span>+</span></span>
              <span class="l">Projects</span>
            </div>
            <div class="hstat">
              <span class="n">85<span>+</span></span>
              <span class="l">Students</span>
            </div>
            <div class="hstat">
              <span class="n">12<span>+</span></span>
              <span class="l">Partners</span>
            </div>
            <div class="hstat">
              <span class="n">98<span>%</span></span>
              <span class="l">Satisfaction</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     ABOUT
════════════════════════════════════════════ -->
  <section id="about">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-lg-6" data-aos="fade-right" data-aos-duration="700">
          <div class="about-img-wrap">
            <img src="img/gradution1.jpg" alt="About VTIB">
            <div class="about-stat-pill">
              <div class="asp-icon"><i class="bi bi-mortarboard-fill"></i></div>
              <div class="asp-text">
                <div class="n">500+</div>
                <div class="l">Graduates Empowered</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 about-text-col" data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
          <div class="sec-eyebrow">About Us</div>
          <h2 class="sec-title">Empowering the Next<br>Generation of <span class="hi">Creators</span></h2>
          <p class="sec-sub mt-3">
            We empower students to showcase their creativity and entrepreneurial
            skills by sharing projects for sale. Whether you want to explore
            innovative ideas or share your own, our platform is the perfect
            place for student creators.
          </p>
          <ul class="about-features">
            <li>
              <span class="ck"><i class="bi bi-check-lg"></i></span>
              Join a community of talented students turning ideas into reality.
            </li>
            <li>
              <span class="ck"><i class="bi bi-check-lg"></i></span>
              Our mission is to provide a supportive space where students can learn, collaborate, and grow.
            </li>
            <li>
              <span class="ck"><i class="bi bi-check-lg"></i></span>
              By connecting creators with a wider audience, we help transform passion into opportunity.
            </li>
          </ul>
          <a href="#" class="btn-primary-green">
            Learn More <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     FEATURED PROJECTS
════════════════════════════════════════════ -->
  <section id="projects">
    <div class="container">
      <div class="section-head">
        <div data-aos="fade-up">
          <div class="sec-eyebrow">Featured Work</div>
          <h2 class="sec-title">Student-Built <span class="hi">Projects</span></h2>
        </div>
        <a href="Project.html" class="view-all-link" data-aos="fade-up" data-aos-delay="100">
          View All Projects <i class="bi bi-arrow-right"></i>
        </a>
      </div>


      <div class="row g-4">

        <?php if (!empty($featured_projects)): ?>

          <?php foreach ($featured_projects as $index => $project): ?>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 80 ?>">

              <div class="pcard">

                <div class="pcard-img">

                  <?php if (!empty($project['image_path'])): ?>

                    <img src="<?= htmlspecialchars($project['image_path']) ?>"
                      alt="<?= htmlspecialchars($project['project_name']) ?>">

                  <?php else: ?>

                    <img src="img/code.jpeg" alt="Project">

                  <?php endif; ?>

                  <div class="pcard-overlay"></div>

                  <span class="pcard-tag">
                    <?= htmlspecialchars($project['category'] ?? 'Project') ?>
                  </span>

                </div>

                <div class="pcard-body">

                  <h5>
                    <?= htmlspecialchars($project['project_name']) ?>
                  </h5>

                  <p>
                    <?= htmlspecialchars(substr($project['description'], 0, 110)) ?>...
                  </p>

                </div>

                <div class="pcard-foot">

                  <div class="pcard-author">
                    <span class="av">
                      <?= strtoupper(substr($project['full_name'], 0, 1)) ?>
                    </span>

                    <?= htmlspecialchars($project['full_name']) ?>
                  </div>

                  <a href="Project.php" class="btn-view">
                    View <i class="bi bi-arrow-right"></i>
                  </a>

                </div>

              </div>

            </div>

          <?php endforeach; ?>

        <?php else: ?>

          <div class="col-12 text-center">
            <p>No featured projects available yet.</p>
          </div>

        <?php endif; ?>

      </div>
  </section>

  <!-- ═══════════════════════════════════════════
     SERVICES
════════════════════════════════════════════ -->
  <section id="services">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <div class="sec-eyebrow center-eyebrow">What We Offer</div>
        <h2 class="sec-title">Our <span class="hi">Services</span></h2>
        <p class="sec-sub mx-auto mt-3">Everything you need to showcase, sell, and grow your student projects in one
          place.</p>
      </div>
      <div class="svc-grid">
        <div class="svc-card" data-aos="fade-up" data-aos-delay="0">
          <div class="svc-icon"><i class="bi bi-cloud-upload-fill"></i></div>
          <h5>Upload &amp; Showcase</h5>
          <p>Easily upload your project and reach a wide audience of students, buyers and industry professionals.</p>
          <div class="svc-arrow">Learn more <i class="bi bi-arrow-right"></i></div>
        </div>
        <div class="svc-card" data-aos="fade-up" data-aos-delay="90">
          <div class="svc-icon"><i class="bi bi-shield-lock-fill"></i></div>
          <h5>Secure Transactions</h5>
          <p>Safe and secure payment system ensuring smooth, trusted project sales with full buyer and seller
            protection.</p>
          <div class="svc-arrow">Learn more <i class="bi bi-arrow-right"></i></div>
        </div>
        <div class="svc-card" data-aos="fade-up" data-aos-delay="180">
          <div class="svc-icon"><i class="bi bi-lightbulb-fill"></i></div>
          <h5>Discover Innovations</h5>
          <p>Explore creative projects and innovative ideas from your peers across every technology category.</p>
          <div class="svc-arrow">Learn more <i class="bi bi-arrow-right"></i></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     PARTNERS (logos)
════════════════════════════════════════════ -->
  <section id="partners-logos">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="partner-text-col">
            <div class="sec-eyebrow">Our Partners</div>
            <h2>We Work With the <br><span>Best Partners</span></h2>
            <p>While we are at the forefront of innovation, we are very familiar with
              a number of delivery methods and are confident we can find the process
              that will best help you meet your goals.</p>
            <a href="#" class="btn-primary-green">Read More <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
          <div class="partner-logos-grid">
            <div class="plogo-card">
              <img src="img/vtib.jpeg" alt="VTIB">
              <span>VTIB</span>
            </div>
            <div class="plogo-card">
              <img src="img/shopify.png" alt="Shopify">
              <span>Shopify</span>
            </div>
            <div class="plogo-card">
              <img src="img/R.png" alt="Google">
              <span>Google</span>
            </div>
            <div class="plogo-card">
              <img src="img/microsoft.webp" alt="Microsoft">
              <span>Microsoft</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     JOIN US / BENEFITS
════════════════════════════════════════════ -->
  <section id="join">
    <div class="bg-mesh"></div>
    <div class="container">
      <div class="text-center" data-aos="fade-up">
        <div class="sec-eyebrow center-eyebrow">Partnership Benefits</div>
        <h2 class="sec-title white-title">Join <span class="hi">Us</span></h2>
        <p class="sec-sub">Become a trusted partner, grow together globally, and unlock new revenue opportunities
          through collaboration.</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
          <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-people-fill"></i></div>
            <h5>Work with a proven partner</h5>
            <p>Scale faster with reliable solutions, tools, and long-term collaboration.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="80">
          <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-globe"></i></div>
            <h5>Launch with a global leader</h5>
            <p>Partner with a globally trusted platform and expand your reach across markets.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="160">
          <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-diagram-3-fill"></i></div>
            <h5>Join a worldwide community</h5>
            <p>Connect with partners worldwide to share experience, insights and growth strategies.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="240">
          <div class="benefit-card">
            <div class="benefit-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <h5>Grow your revenue</h5>
            <p>Unlock new income streams through referrals, integrations and premium services.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ -->
  <footer id="footer">
    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-brand">
            <span class="fn">VTIB</span>
            <p>Innovating the digital landscape with elegant solutions, empowering student talent and timeless design.
            </p>
            <div class="footer-socials">
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
              <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>Company</h5>
            <ul>
              <li><a href="#about">About Us</a></li>
              <li><a href="#">Our Team</a></li>
              <li><a href="#">Careers</a></li>
            </ul>
          </div>
        </div>

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

        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>Contact</h5>
            <ul>
              <li><a href="tel:+237679318844">679318844 / 695593749</a></li>
              <li><a href="tel:+237650857613">650857613 / 651857081</a></li>
              <li><a href="/cdn-cgi/l/email-protection#fc95929a93bc8a88959ed29f9391"><span class="__cf_email__"
                    data-cfemail="41282f272e01373528236f222e2c">[email&#160;protected]</span></a></li>
              <li><a href="#">Ange Raphael, Douala</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2">
          <div class="footer-cta-box">
            <h5>Let's Connect</h5>
            <p>Ready to join the VTIB community?</p>
            <a href="contact.html" class="btn-footer-cta">
              <i class="bi bi-send-fill"></i> Get in Touch
            </a>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="footer-bottom-inner">
          <p>© <strong class="copyright-brand">VTIB Marketplace</strong>. All rights reserved.</p>
          <div class="credits">Designed by <a href="#">VTIB 2025/2026</a></div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" class="scroll-top" id="scrollTop" title="Scroll to top"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Cloudflare email decode (auto-injected) -->
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>

  <!-- AOS animations -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

  <!-- Bootstrap JS bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ═══════════════════════════════════════════
     PAGE SCRIPTS
════════════════════════════════════════════ -->
  <script>
    AOS.init({ duration: 650, easing: 'ease-out-cubic', once: true, offset: 0, initClassName: 'aos-init', animatedClassName: 'aos-animate' });

    /* ── Header scroll class ── */
    const hdr = document.getElementById('siteHeader');
    window.addEventListener('scroll', () => {
      hdr.classList.toggle('scrolled', window.scrollY > 40);
    });

    /* ── Scroll top ── */
    const st = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => st.classList.toggle('show', window.scrollY > 120));
    st.addEventListener('click', e => { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); });

    /* ── Mobile nav ── */
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

    /* ── Brand logo fallback ── */
    const logoImg = document.querySelector('.brand-logo img');
    if (logoImg) {
      logoImg.addEventListener('error', () => {
        logoImg.style.display = 'none';
        document.getElementById('brandFallback').style.display = 'block';
      });
    }

    /* ── Theme Toggle ── */
    const themeBtn = document.getElementById('themeToggle');
    const root = document.documentElement;
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

    /* ── Active nav on scroll ── */
    const sections = document.querySelectorAll('section[id], div[id="home"]');
    const navLinks = document.querySelectorAll('.main-nav a');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(s => {
        if (window.scrollY >= s.offsetTop - 120) current = s.id;
      });
      navLinks.forEach(a => {
        a.classList.remove('active');
        if (a.getAttribute('href') === '#' + current || (current === 'home' && a.getAttribute('href') === '#')) {
          a.classList.add('active');
        }
      });
    }, { passive: true });
  </script>


  <script>
    // Initialize Google Translate
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,zh-CN,es,hi,ar,fr,bn,pt,ru,ja',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }

    // Load Google Script
    (function () {
      var gt = document.createElement('script');
      gt.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
      document.body.appendChild(gt);
    })();

    // Toggle Menu Visibility
    const btn = document.getElementById('ui-translate-btn');
    const menu = document.getElementById('ui-lang-menu');

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      menu.classList.toggle('active');
    });

    // The Function to trigger translation
    function changeLanguage(langCode) {
      var selectField = document.querySelector("#google_translate_element select");
      if (selectField) {
        selectField.value = langCode;
        // Trigger the 'change' event so Google knows we picked a language
        selectField.dispatchEvent(new Event('change'));
      }
      menu.classList.remove('active');
    }

    // Close menu if clicking outside
    document.addEventListener('click', () => menu.classList.remove('active'));
  </script>

  <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,zh-CN,es,hi,ar,fr,bn,pt,ru,ja',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
  </script>