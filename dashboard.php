<?php
/* ═══════════════════════════════════════════════════════════════
   dashboard.php — VTIB Student Portfolio Dashboard
═══════════════════════════════════════════════════════════════ */

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once 'config/db.php';

$user_id = $_SESSION['user_id'];
$errors = [];

/* CREATE MISSING COLUMNS */
try {
  $pdo->exec("ALTER TABLE projects ADD COLUMN category VARCHAR(60) NOT NULL DEFAULT 'Other'");
} catch (Exception $e) {
}
try {
  $pdo->exec("ALTER TABLE projects ADD COLUMN tags VARCHAR(255) DEFAULT NULL");
} catch (Exception $e) {
}
try {
  $pdo->exec("ALTER TABLE projects ADD COLUMN demo_link VARCHAR(255) DEFAULT NULL");
} catch (Exception $e) {
}
try {
  $pdo->exec("ALTER TABLE projects ADD COLUMN whatsapp_number VARCHAR(30) DEFAULT NULL");
} catch (Exception $e) {
}

/* GET USER */
$stmt = $pdo->prepare("SELECT name FROM students WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$full_name = $user ? $user['name'] : 'Student';

/* DELETE PROJECT */
if (isset($_GET['action']) && $_GET['action'] === 'delete' && !empty($_GET['id'])) {
  $pid = (int) $_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND student_id = ?");
  $stmt->execute([$pid, $user_id]);
  $project = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($project) {
    if (!empty($project['image_path']) && file_exists($project['image_path'])) {
      unlink($project['image_path']);
    }
    $pdo->prepare("DELETE FROM projects WHERE id = ? AND student_id = ?")->execute([$pid, $user_id]);
    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Project deleted successfully.'];
  }
  header("Location: dashboard.php");
  exit();
}

/* UPLOAD PROJECT */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'upload') {

  $project_name = trim($_POST['project_name'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $category = trim($_POST['category'] ?? 'Other');
  $tags = trim($_POST['tags'] ?? '');
  $status = trim($_POST['status'] ?? 'free');
  $github_link = trim($_POST['github_link'] ?? '');
  $demo_link = trim($_POST['demo_link'] ?? '');
  $contact_email = trim($_POST['contact_email'] ?? '');
  $whatsapp_number = trim($_POST['whatsapp_number'] ?? '');

  if ($project_name === '')
    $errors[] = "Project name is required.";
  if ($description === '')
    $errors[] = "Description is required.";
  if (empty($_FILES['project_image']['name']))
    $errors[] = "Project image is required.";

  if (empty($errors)) {
    $img = $_FILES['project_image'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
      $errors[] = "Invalid image type.";
    } else {
      if (!is_dir('uploads/images'))
        mkdir('uploads/images', 0777, true);
      $image_name = time() . '_' . rand(1000, 9999) . '.' . $ext;
      $image_path = 'uploads/images/' . $image_name;
      move_uploaded_file($img['tmp_name'], $image_path);
    }
  }

  if (empty($errors)) {
    $download_code = ($status === 'free') ? $github_link : null;
    $demo_stored = ($status === 'paid') ? $demo_link : null;
    $contact_store = ($status === 'paid') ? $contact_email : null;
    $whatsapp_store = ($status === 'paid') ? $whatsapp_number : null;
    $sql = "INSERT INTO projects (
  student_id,
  project_name,
  description,
  image_path,
  status,
  download_code,
  contact_email,
  category,
  tags,
  demo_link,
  whatsapp_number
)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      $user_id,
      $project_name,
      $description,
      $image_path,
      $status,
      $download_code,
      $contact_store,
      $category,
      $tags,
      $demo_stored,
      $whatsapp_store
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Project uploaded successfully.'];
    header("Location: dashboard.php");
    exit();
  }
}

/* EDIT PROJECT */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_action'] ?? '') === 'edit') {
  $project_id = (int) $_POST['project_id'];
  $project_name = trim($_POST['project_name'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $category = trim($_POST['category'] ?? '');
  $tags = trim($_POST['tags'] ?? '');
  $status = trim($_POST['status'] ?? '');
  $github_link = trim($_POST['github_link'] ?? '');
  $demo_link = trim($_POST['demo_link'] ?? '');
  $contact_email = trim($_POST['contact_email'] ?? '');

  $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND student_id = ?");
  $stmt->execute([$project_id, $user_id]);
  $project = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($project) {
    $image_path = $project['image_path'];

    if (!empty($_FILES['project_image']['name'])) {
      $img = $_FILES['project_image'];
      $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
      $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

      if (in_array($ext, $allowed)) {
        if (!is_dir('uploads/images'))
          mkdir('uploads/images', 0777, true);
        if (!empty($image_path) && file_exists($image_path))
          unlink($image_path);
        $new_name = time() . '_' . rand(1000, 9999) . '.' . $ext;
        $image_path = 'uploads/images/' . $new_name;
        move_uploaded_file($img['tmp_name'], $image_path);
      }
    }

    $download_code = ($status === 'free') ? $github_link : null;
    $demo_stored = ($status === 'paid') ? $demo_link : null;
    $contact_store = ($status === 'paid') ? $contact_email : null;

    $sql = "UPDATE projects SET project_name=?, description=?, image_path=?, status=?, download_code=?, contact_email=?, category=?, tags=?, demo_link=? 
                WHERE id = ? AND student_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_name, $description, $image_path, $status, $download_code, $contact_store, $category, $tags, $demo_stored, $project_id, $user_id]);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Project updated successfully.'];
    header("Location: dashboard.php");
    exit();
  }
}

/* GET PROJECTS */
$stmt = $pdo->prepare("SELECT * FROM projects WHERE student_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$categories = ['Web App', 'Mobile App', 'AI / ML', 'Desktop App', 'Game', 'Cybersecurity', 'UI/UX', 'Other'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — VTIB Marketplace</title>
  <link href="img/favicon.png" rel="icon">
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="main.css">

  <style>
    .dash-root {
      display: flex;
      min-height: 100vh;
      background: var(--bg);
    }

    .dash-sidebar {
      width: 280px;
      background: var(--surface);
      border-right: 1px solid var(--border);
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      overflow-y: auto;
      z-index: 100;
      display: flex;
      flex-direction: column;
    }

    .dash-main {
      flex: 1;
      margin-left: 280px;
      padding: 40px;
    }

    .sidebar-profile {
      padding: 32px 24px;
      text-align: center;
      border-bottom: 1px solid var(--border);
    }

    .s-avatar {
      width: 82px;
      height: 82px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--em), #34d399);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      font-weight: 800;
      margin: 0 auto 12px;
    }

    .snav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 20px;
      border-radius: 12px;
      color: var(--text);
      text-decoration: none;
      margin-bottom: 4px;
      transition: all 0.2s;
    }

    .snav-item:hover,
    .snav-item.active {
      background: rgba(34, 160, 107, 0.1);
      color: var(--em);
    }

    .project-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    .project-card {
      height: 100%;
      transition: all 0.3s ease;
    }

    .project-card:hover {
      transform: translateY(-8px);
      box-shadow: var(--sh-lg) !important;
    }

    .demo-link-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7));
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .project-image-wrapper {
      position: relative;
      overflow: hidden;
    }

    .project-image-wrapper img {
      transition: transform 0.4s ease;
    }

    .project-card:hover .project-image-wrapper img {
      transform: scale(1.05);
    }

    .project-card:hover .demo-link-overlay {
      opacity: 1;
    }

    .demo-link-overlay .btn {
      transform: translateY(20px);
      transition: all 0.3s ease;
    }

    .project-card:hover .demo-link-overlay .btn {
      transform: translateY(0);
    }
  </style>
</head>

<body>

  <div class="dash-root">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
      <div class="sidebar-profile">
        <div class="s-avatar"><?= strtoupper(substr($full_name, 0, 1)) ?></div>
        <h5><?= htmlspecialchars($full_name) ?></h5>
        <small class="text-muted">VTIB Student</small>
      </div>

      <div class="p-3">
        <a href="dashboard.php" class="snav-item active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
        <a href="#" class="snav-item" data-bs-toggle="modal" data-bs-target="#uploadModal"><i
            class="bi bi-cloud-upload"></i> Upload Project</a>
        <a href="Project.php" class="snav-item"><i class="bi bi-folder2-open"></i> Browse Projects</a>
        <a href="#" class="snav-item"><i class="bi bi-person-badge"></i> My Portfolio</a>
        <a href="logout.php" class="snav-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dash-main">

      <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
          <h1 class="display-6 fw-bold">Good morning, <?= htmlspecialchars($full_name) ?> 👋</h1>
          <p class="text-muted">Here's a snapshot of your projects today</p>
        </div>
        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#uploadModal">
          <i class="bi bi-plus-lg"></i> New Project
        </button>
      </div>

      <?php if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?>"><?= htmlspecialchars($flash['msg']) ?></div>
      <?php endif; ?>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <?php foreach ($errors as $err): ?>
            <div><?= htmlspecialchars($err) ?></div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- PROJECTS -->
      <div class="project-grid">
        <?php foreach ($projects as $project): ?>
          <?php $tags = explode(',', $project['tags'] ?? ''); ?>

          <div class="project-card card h-100 shadow-sm border-0">

            <div class="project-image-wrapper position-relative overflow-hidden">

              <img src="<?= htmlspecialchars($project['image_path']) ?>" class="card-img-top"
                style="height: 180px; object-fit: cover;" alt="">

              <?php if (!empty($project['download_code']) || !empty($project['demo_link'])): ?>

                <div class="demo-link-overlay">

                  <a href="<?= htmlspecialchars($project['download_code'] ?: $project['demo_link']) ?>" target="_blank"
                    class="btn btn-light fw-semibold px-4">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Demo Link
                  </a>

                </div>

              <?php endif; ?>

            </div>
            <div class="card-body d-flex flex-column">
              <h5><?= htmlspecialchars($project['project_name']) ?></h5>
              <p class="card-text text-muted flex-grow-1">
                <?= htmlspecialchars(substr($project['description'], 0, 120)) ?>...
              </p>

              <div class="mt-auto">
                <span
                  class="badge <?= strtolower($project['status']) === 'free' ? 'bg-success' : 'bg-warning text-dark' ?>">
                  <?= ucfirst($project['status']) ?>
                </span>
              </div>
            </div>
            <div class="card-footer bg-white border-0 d-flex gap-2">
              <a href="dashboard.php?action=delete&id=<?= $project['id'] ?>"
                onclick="return confirm('Are you sure you want to delete this project?')"
                class="btn btn-outline-danger btn-sm flex-fill">
                <i class="bi bi-trash"></i>
              </a>
              <button class="btn btn-outline-primary btn-sm flex-fill" data-bs-toggle="modal"
                data-bs-target="#editModal<?= $project['id'] ?>">
                <i class="bi bi-pencil"></i> Edit
              </button>
            </div>
          </div>

          <!-- EDIT MODAL -->
          <div class="modal fade" id="editModal<?= $project['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="_action" value="edit">
                  <input type="hidden" name="project_id" value="<?= $project['id'] ?>">

                  <div class="modal-header">
                    <h5>Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    <!-- Your original edit form fields -->
                    <div class="mb-3">
                      <label>Project Name</label>
                      <input type="text" name="project_name" class="form-control"
                        value="<?= htmlspecialchars($project['project_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                      <label>Description</label>
                      <textarea name="description" class="form-control" rows="5"
                        required><?= htmlspecialchars($project['description']) ?></textarea>
                    </div>
                    <!-- Add other fields as needed from your original code -->
                  </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </main>
  </div>

  <!-- UPLOAD MODAL -->
  <div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_action" value="upload">

          <div class="modal-header">
            <h5>Upload New Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label>Project Name</label>
              <input type="text" name="project_name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
              <label>Category</label>
              <select name="category" class="form-select">
                <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat ?>"><?= $cat ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label>Tags (comma separated)</label>
              <input type="text" name="tags" class="form-control">
            </div>
            <div class="mb-3">
              <label>Status</label>
              <select name="status" class="form-select" onchange="toggleUploadFields(this)">
                <option value="free">Free</option>
                <option value="paid">Paid</option>
              </select>
            </div>

            <div id="uploadFree">
              <div class="mb-3">
                <label>GitHub / Download Link</label>
                <input type="url" name="github_link" id="github_link" class="form-control">
              </div>
            </div>

            <div id="uploadPaid" style="display:none">
              <div class="mb-3">
                <label>Demo Link</label>
                <input type="url" name="demo_link"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                  placeholder="https://github.com/username/repo">
              </div>
              <div class="mb-3">
                <label>Contact Email</label>
                <input type="email" name="contact_email" class="form-control">
              </div>
            </div>
            <div class="mb-3">
              <label>WhatsApp Number</label>
              <input type="text" name="whatsapp_number" class="form-control" placeholder="e.g. 237650857613">
            </div>

            <div class="mb-3">
              <label>Project Image</label>
              <input type="file" name="project_image" class="form-control" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Publish Project</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="main.js"></script>

  <script>
    function toggleUploadFields(select) {

      const isFree = select.value === 'free';

      document.getElementById('uploadFree').style.display =
        isFree ? 'block' : 'none';

      document.getElementById('uploadPaid').style.display =
        isFree ? 'none' : 'block';

      const githubInput = document.getElementById('github_link');

      if (isFree) {
        githubInput.setAttribute('required', 'required');
      } else {
        githubInput.removeAttribute('required');
        githubInput.value = '';
      }
    }
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
      }
    }
  </script>
</body>

</html>