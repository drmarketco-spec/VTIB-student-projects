<?php
session_start();
require_once 'config/db.php';

$stmt = $pdo->query("
    SELECT p.*, s.name AS full_name 
    FROM projects p 
    JOIN students s ON s.id = p.student_id 
    ORDER BY p.created_at DESC
");
$all_projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Projects — VTIB Marketplace</title>
  <link href="img/favicon.png" rel="icon">
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="main.css">

  <style>
    .project-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    .proj-card {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .proj-card-img {
      height: 190px;
      overflow: hidden;
      position: relative;
    }

    .proj-card-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .proj-card:hover .proj-card-img img {
      transform: scale(1.08);
    }

    .proj-card-body {
      flex: 1;
      padding: 18px 20px 0;
    }

    .proj-card-footer {
      margin-top: auto;
      padding: 16px 20px;
    }

    .price-tag {
      color: #22c55e;
      font-weight: 700;
      font-size: 1.05rem;
    }

    .demo-link-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom,
          rgba(0, 0, 0, 0.25),
          rgba(0, 0, 0, 0.72));
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .demo-link-overlay .btn {
      transform: translateY(20px);
      transition: all 0.3s ease;
      border-radius: 12px;
    }

    .proj-card:hover .demo-link-overlay {
      opacity: 1;
    }

    .proj-card:hover .demo-link-overlay .btn {
      transform: translateY(0);
    }

    .proj-card-img img {
      transition: transform 0.5s ease;
    }

    .proj-card:hover .proj-card-img img {
      transform: scale(1.08);
    }
  </style>
</head>

<body>

  <!-- ==================== HEADER ==================== -->
  <header class="site-header" id="siteHeader">
    <div class="topbar">
      <div class="container topbar-inner">
        <div class="topbar-contacts">
          <a href="tel:+237650857613"><i class="bi bi-telephone-fill"></i>(+237) 650857613, 679318844</a>
          <a href="#"><i class="bi bi-envelope-fill"></i>scolarite@vtib-eportal.net</a>
        </div>
        <div class="topbar-search">
          <i class="bi bi-search"></i>
          <input type="text" placeholder="Search projects...">
        </div>
      </div>
    </div>

    <div class="container">
      <div class="navbar-row">
        <a href="http://localhost/vtib-student-projects/index.php" class="brand">
          <div class="brand-logo">
            <img src="img/logo.png" alt="VTIB" onerror="this.style.display='none'">
            <span id="brandFallback" style="display:none">VT</span>
          </div>
          <span class="brand-name">VTIB</span>
        </a>

        <ul class="main-nav" id="mainNav">
          <li><a href="http://localhost/vtib-student-projects/index.php">Home</a></li>
          <li><a href="http://localhost/vtib-student-projects/vtib-about.php">About</a></li>
          <li><a href="http://localhost/vtib-student-projects/Project.php" class="active">Projects</a></li>
          <li><a href="http://localhost/vtib-student-projects/contact.php">Contact</a></li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
          <?php else: ?>
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>

        <button class="nav-ham" id="navHam"><i class="bi bi-list"></i></button>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="page-hero">
    <div class="container">
      <h1>Where Student Innovation <span>Takes the Lead</span></h1>
      <p>Discover amazing projects built by VTIB students — from web apps to AI tools.</p>
      <a href="#projects" class="hero-scroll-btn">
        <i class="bi bi-grid-fill"></i> Explore All Projects
      </a>
    </div>
  </section>

  <!-- PROJECTS SECTION -->
  <section class="projects-section" id="projects">
    <div class="container">
      <h2>Student Projects</h2>
      <p class="subtitle">Showing <span id="count"><?= count($all_projects) ?></span> projects</p>

      <div class="filter-bar">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="free">Free</button>
        <button class="filter-btn" data-filter="paid">Paid</button>
      </div>

      <div class="project-grid" id="projectGrid">
        <?php if (empty($all_projects)): ?>
          <p class="text-center py-5">No projects published yet. Be the first to upload your project!</p>
        <?php else: ?>
          <?php foreach ($all_projects as $proj):
            $status = strtolower($proj['status'] ?? 'free');
            ?>
            <div class="proj-card" data-category="<?= $status ?>">
              <div class="proj-card-img">

                <span class="proj-card-badge"><?= ucfirst($status) ?></span>

                <?php if (!empty($proj['image_path'])): ?>

                  <img src="<?= htmlspecialchars($proj['image_path']) ?>"
                    alt="<?= htmlspecialchars($proj['project_name']) ?>">

                <?php else: ?>

                  <div class="proj-initials">
                    <?= strtoupper(substr($proj['project_name'], 0, 1)) ?>
                  </div>

                <?php endif; ?>

                <?php if (!empty($proj['download_code']) || !empty($proj['demo_link'])): ?>

                  <div class="demo-link-overlay">

                    <a href="<?= htmlspecialchars($proj['download_code'] ?: $proj['demo_link']) ?>" target="_blank"
                      class="btn btn-light fw-semibold px-4">
                      <i class="bi bi-box-arrow-up-right"></i>
                      Demo Link
                    </a>

                  </div>

                <?php endif; ?>

              </div>
              <div class="proj-card-body">
                <h3><?= htmlspecialchars($proj['project_name']) ?></h3>
                <p><?= htmlspecialchars(substr($proj['description'] ?? '', 0, 95)) ?>...</p>
                <small class="text-muted">By <?= htmlspecialchars($proj['full_name']) ?></small>
              </div>
              <div class="proj-card-footer">
                <?php if ($status === 'paid' && !empty($proj['price'])): ?>
                  <span class="price-tag">💰 <?= number_format($proj['price']) ?> XAF</span>
                <?php endif; ?>
                <?php if ($status === 'free'): ?>

                  <a href="<?= htmlspecialchars($proj['download_code']) ?>" target="_blank"
                    class="btn-view text-decoration-none">
                    Download
                    <i class="bi bi-arrow-right"></i>
                  </a>

                <?php else: ?>

                  <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $proj['whatsapp_number']) ?>?text=Hello%20I%20am%20interested%20in%20your%20project:%20<?= urlencode($proj['project_name']) ?>"
                    target="_blank" class="btn-view text-decoration-none">
                    Contact Seller
                    <i class="bi bi-whatsapp"></i>
                  </a>

                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ==================== FOOTER (Copied from index.html) ==================== -->
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
              <li><a href="vtib-about.html">About Us</a></li>
              <li><a href="#">Our Team</a></li>
              <li><a href="#">Careers</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>Programs</h5>
            <ul>
              <li><a href="https://vtib-eportal.net/certification_detail.php?code=BeWD">Software Engineering</a></li>
              <li><a href="https://vtib-eportal.net/certification_detail.php?code=BeWD">Networking &amp; Security</a></li>
              <li><a href="https://vtib-eportal.net/certification_detail.php?code=BeWD">Computer Graphics</a></li>
              <li><a href="https://vtib-eportal.net/certification_detail.php?code=BeWD">And more…</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2 col-md-4">
          <div class="footer-col">
            <h5>Contact</h5>
            <ul>
              <li><a href="tel:+237679318844">679318844 / 695593749</a></li>
              <li><a href="tel:+237650857613">650857613 / 651857081</a></li>
              <li><a href="mailto:scolarite@vtib-eportal.net">scolarite@vtib-eportal.net</a></li>
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
  <a href="#" class="scroll-top" id="scrollTop"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="main.js"></script>

  <script>
    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filterValue = this.getAttribute('data-filter');
        document.querySelectorAll('.proj-card').forEach(card => {
          if (filterValue === 'all') {
            card.style.display = 'flex';
          } else {
            card.style.display = (card.getAttribute('data-category') === filterValue) ? 'flex' : 'none';
          }
        });
      });
    });
  </script>
</body>

</html>