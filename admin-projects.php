<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

require_once 'config/db.php';

/* PROJECTS */
$projects = $pdo->query("
    SELECT p.*, s.name as student_name 
    FROM projects p 
    JOIN students s ON s.id = p.student_id 
    ORDER BY p.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Projects - VTIB Admin</title>
    <link href="img/favicon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
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
            top: 0; left: 0; height: 100vh;
            overflow-y: auto;
            z-index: 100;
        }
        .dash-main { 
            flex: 1; 
            margin-left: 280px; 
            padding: 40px; 
        }

        .admin-card {
            background: var(--surface);
            border-radius: 20px;
            box-shadow: var(--sh);
            padding: 24px;
        }

        .snav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 12px;
            color: var(--text);
            text-decoration: none;
            margin-bottom: 6px;
            transition: all 0.3s;
        }
        .snav-item:hover,
        .snav-item.active {
            background: rgba(34, 160, 107, 0.1);
            color: var(--em);
        }
        .table th { 
            background: var(--bg-2); 
            font-weight: 600; 
        }
    </style>
</head>
<body>

<div class="dash-root">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
        <div class="p-4 text-center border-bottom">
            <h4 class="fw-bold text-success mb-1">VTIB Admin</h4>
            <p class="mb-0 text-muted"><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?></p>
        </div>

        <div class="p-3">
            <a href="admin-dashboard.php" class="snav-item">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="admin-students.php" class="snav-item">
                <i class="bi bi-people-fill"></i> All Students
            </a>
            <a href="admin-projects.php" class="snav-item active">
                <i class="bi bi-folder2-open"></i> All Projects
            </a>
            <a href="admin-logout.php" class="snav-item text-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dash-main">
        <h1 class="display-6 fw-bold mb-4">All Projects</h1>

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Student</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">No projects uploaded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($projects as $project): ?>
                            <tr>
                                <td><?= htmlspecialchars($project['project_name']) ?></td>
                                <td><?= htmlspecialchars($project['student_name']) ?></td>
                                <td>
                                    <span class="badge bg-<?= ($project['status_admin'] ?? 'active') === 'active' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($project['status_admin'] ?? 'active') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if(($project['status_admin'] ?? 'active') === 'active'): ?>
                                        <a href="suspend-project.php?id=<?= $project['id'] ?>" 
                                           class="btn btn-warning btn-sm">Suspend</a>
                                    <?php else: ?>
                                        <span class="text-muted small">Suspended</span>
                                    <?php endif; ?>
                                    
                                    <a target="_blank" 
                                       href="https://wa.me/<?= preg_replace('/[^0-9]/','', $project['whatsapp_number'] ?? '') ?>?text=Hello%20<?= urlencode($project['student_name']) ?>,%20your%20project%20<?= htmlspecialchars($project['project_name']) ?>%20requires%20attention." 
                                       class="btn btn-success btn-sm ms-2">
                                        <i class="bi bi-whatsapp"></i> Notify
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>