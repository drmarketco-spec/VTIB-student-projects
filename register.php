<?php
session_start();
require_once 'config/db.php';

$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Name validation
    if (empty($name)) {
        $errors[] = "Full name is required";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }

    // Password length
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    // Password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Check existing email
    $stmt = $pdo->prepare("SELECT id FROM students WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $errors[] = "Email already registered";
    }

    // Insert user
    if (empty($errors)) {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO students(name, email, password)
            VALUES(?, ?, ?)
        ");

        try {

            $stmt->execute([
                $name,
                $email,
                $hashed_password
            ]);

            header("Location: dashboard.php?success=registered");
            exit();

        } catch(PDOException $e) {

            $errors[] = "Registration failed. Please try again.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>VTIB Register</title>

<link href="img/favicon.png" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

:root{
    --primary: #00b050;
    --primary-dark: #08763b;
    --light-bg: #f4f8f5;
    --dark: #1f2937;
    --border: #dfe7e2;
    --white: #ffffff;
    --text-light: #6b7280;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#eef8f0,#f8fbf9);
    min-height:100vh;
    overflow-x:hidden;
}

/* Main Layout */
.auth-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
}

/* Main Card */
.auth-container{
    width:100%;
    max-width:1100px;
    background:var(--white);
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,0.08);
    display:flex;
    flex-wrap:wrap;
}

/* LEFT SIDE */
.auth-left{
    flex:1;
    min-width:320px;
    background:linear-gradient(
        135deg,
        #0b8f44,
        #00b050
    );
    color:white;
    padding:60px 40px;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
}

.logo-box img{
    width:180px;
    max-width:100%;
    margin-bottom:20px;
}

.school-title{
    font-size:2rem;
    font-weight:700;
    margin-bottom:10px;
}

.school-text{
    font-size:15px;
    line-height:1.8;
    opacity:0.95;
    max-width:400px;
}

/* RIGHT SIDE */
.auth-right{
    flex:1;
    min-width:320px;
    padding:60px 50px;
    background:white;
}

.form-title{
    font-size:2rem;
    font-weight:700;
    color:var(--dark);
    margin-bottom:10px;
}

.form-subtitle{
    color:var(--text-light);
    margin-bottom:35px;
}

/* Input */
.form-control{
    height:58px;
    border-radius:14px;
    border:1px solid var(--border);
    padding-left:18px;
    font-size:15px;
    transition:0.3s;
    box-shadow:none !important;
}

.form-control:focus{
    border-color:var(--primary);
}

/* Input icons */
.input-group-text{
    border-radius:14px 0 0 14px;
    background:#f8faf9;
    border:1px solid var(--border);
    border-right:none;
}

.input-group .form-control{
    border-left:none;
}

/* Button */
.btn-register{
    height:58px;
    border:none;
    border-radius:14px;
    background:linear-gradient(
        135deg,
        var(--primary),
        var(--primary-dark)
    );
    color:white;
    font-weight:600;
    font-size:16px;
    transition:0.3s;
}

.btn-register:hover{
    transform:translateY(-2px);
}

/* Alert */
.alert{
    border-radius:12px;
    font-size:14px;
}

/* Login Link */
.login-link{
    color:var(--primary-dark);
    font-weight:600;
    text-decoration:none;
}

.login-link:hover{
    text-decoration:underline;
}

/* Responsive */
@media(max-width:991px){

    .auth-container{
        flex-direction:column;
    }

    .auth-left,
    .auth-right{
        width:100%;
    }

    .auth-left{
        padding:40px 25px;
    }

    .auth-right{
        padding:40px 25px;
    }

    .school-title{
        font-size:1.7rem;
    }

    .form-title{
        font-size:1.7rem;
    }
}

@media(max-width:576px){

    .auth-wrapper{
        padding:20px 10px;
    }

    .auth-right{
        padding:35px 20px;
    }

    .auth-left{
        padding:35px 20px;
    }

    .logo-box img{
        width:140px;
    }

    .form-control,
    .btn-register{
        height:54px;
    }
}

</style>
</head>

<body>

<div class="auth-wrapper">

    <div class="auth-container">

        <!-- LEFT SIDE -->
        <div class="auth-left">

            <div class="logo-box">
                <img src="img/logo.png" alt="VTIB Logo">
            </div>

            <h1 class="school-title">
                VTIB Student Portfolio
            </h1>

            <p class="school-text">
                Join the Vocational Training Institute Best Technology
                innovation platform and showcase your projects,
                skills, achievements and digital creativity.
            </p>

        </div>

        <!-- RIGHT SIDE -->
        <div class="auth-right">

            <h2 class="form-title">
                Create Account
            </h2>

            <p class="form-subtitle">
                Register to access your student dashboard.
            </p>

            <!-- Error Messages -->
            <?php foreach($errors as $error): ?>

                <div class="alert alert-danger d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endforeach; ?>

            <!-- Form -->
            <form method="POST">

                <!-- Name -->
                <div class="mb-3">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Full Name"
                            value="<?= htmlspecialchars($name) ?>"
                            required
                        >

                    </div>

                </div>

                <!-- Email -->
                <div class="mb-3">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Email Address"
                            value="<?= htmlspecialchars($email) ?>"
                            required
                        >

                    </div>

                </div>

                <!-- Password -->
                <div class="mb-3">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Password"
                            required
                        >

                    </div>

                </div>

                <!-- Confirm Password -->
                <div class="mb-4">

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control"
                            placeholder="Confirm Password"
                            required
                        >

                    </div>

                </div>

                <!-- Button -->
                <button type="submit" class="btn btn-register w-100">

                    <i class="bi bi-person-plus-fill"></i>
                    Create Account

                </button>

            </form>

            <!-- Login -->
            <div class="text-center mt-4">

                Already have an account?

                <a href="login.php" class="login-link">
                    Login here
                </a>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>