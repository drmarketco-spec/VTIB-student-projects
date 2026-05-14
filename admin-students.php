<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

require_once 'config/db.php';

/* STUDENTS */
$students = $pdo->query("
    SELECT * FROM students ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students - VTIB Admin</title>
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
            <a href="admin-students.php" class="snav-item active">
                <i class="bi bi-people-fill"></i> All Students
            </a>
            <a href="admin-projects.php" class="snav-item">
                <i class="bi bi-folder2-open"></i> All Projects
            </a>
            <a href="admin-logout.php" class="snav-item text-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="dash-main">
        <h1 class="display-6 fw-bold mb-4">All Students</h1>

        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($students)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">No students registered yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $student['status']=='active' ? 'success' : ($student['status']=='suspended' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($student['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($student['status'] !== 'suspended'): ?>
                                        <a href="suspend-student.php?id=<?= $student['id'] ?>" class="btn btn-warning btn-sm">Suspend</a>
                                    <?php endif; ?>
                                    <a href="delete-student.php?id=<?= $student['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to soft delete this student?')">
                                        Delete
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