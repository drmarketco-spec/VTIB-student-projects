<?php
session_start();
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email=? LIMIT 1");
    $stmt->execute([$email]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'];

        header("Location: admin-dashboard.php");
        exit();

    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - VTIB</title>
    <link href="img/favicon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --primary:#00b050;
            --primary-dark:#08763b;
            --bg:#f3f8f4;
            --white:#ffffff;
            --dark:#1f2937;
            --text-light:#6b7280;
            --border:#dfe7e2;
        }

        *{ margin:0; padding:0; box-sizing:border-box; }
        body{
            font-family:'Poppins', sans-serif;
            background:linear-gradient(135deg,#eef8f0,#f8fbf9);
        }

        .auth-wrapper{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px 15px;
        }

        .auth-container{
            width:100%;
            max-width:1100px;
            background:var(--white);
            border-radius:28px;
            overflow:hidden;
            display:flex;
            flex-wrap:wrap;
            box-shadow:0 20px 60px rgba(0,0,0,0.08);
        }

        .auth-left{
            flex:1;
            min-width:320px;
            background:linear-gradient(135deg, #0b8f44, #00b050);
            color:white;
            padding:60px 40px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
        }

        .auth-right{
            flex:1;
            min-width:320px;
            padding:60px 50px;
        }

        .form-title{
            font-size:2.1rem;
            font-weight:700;
            color:var(--dark);
        }

        .input-group-text{
            border-radius:14px 0 0 14px;
            border:1px solid var(--border);
            border-right:none;
            background:#f9fbfa;
        }

        .form-control{
            height:58px;
            border-radius:14px;
            border:1px solid var(--border);
        }

        .form-control:focus{
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(0,176,80,0.15);
        }

        .btn-login{
            height:58px;
            border:none;
            border-radius:14px;
            background:linear-gradient(135deg, var(--primary), var(--primary-dark));
            color:white;
            font-size:16px;
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-container">

        <!-- LEFT PANEL -->
        <div class="auth-left">
            <img src="img/logo.png" alt="VTIB Logo" style="width:180px; margin-bottom:20px;">
            <h1 class="school-title">Admin Portal</h1>
            <p class="school-text">
                Manage students, review projects, and ensure platform quality.
            </p>
        </div>

        <!-- RIGHT PANEL -->
        <div class="auth-right">
            <h2 class="form-title mb-2">Admin Login</h2>
            <p class="text-muted mb-4">Access the administration dashboard</p>

            <?php if($error): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-shield-lock me-2"></i>Login to Admin Panel
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="login.php" class="text-muted">← Back to Student Login</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>