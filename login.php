<?php
session_start();
require_once 'config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Fetch user
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    // Verify Password
    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid email or password";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - VTIB Student Portfolio</title>

<link href="img/favicon.png" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
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

/* Reset */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins', sans-serif;
    background:linear-gradient(135deg,#eef8f0,#f8fbf9);
    overflow-x:hidden;
}

/* MAIN WRAPPER */
.auth-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
}

/* CARD */
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

/* LEFT PANEL */
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
    justify-content:center;
    align-items:center;
    text-align:center;
}

.logo-box img{
    width:190px;
    max-width:100%;
    margin-bottom:20px;
}

.school-title{
    font-size:2rem;
    font-weight:700;
    margin-bottom:15px;
}

.school-text{
    font-size:15px;
    line-height:1.8;
    max-width:420px;
    opacity:0.95;
}

/* RIGHT PANEL */
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

/* INPUTS */
.input-group-text{
    border-radius:14px 0 0 14px;
    border:1px solid var(--border);
    border-right:none;
    background:#f9fbfa;
}

.input-group .form-control{
    border-left:none;
}

.form-control{
    height:58px;
    border-radius:14px;
    border:1px solid var(--border);
    font-size:15px;
    padding-left:15px;
    box-shadow:none !important;
}

.form-control:focus{
    border-color:var(--primary);
}

/* BUTTON */
.btn-login{
    height:58px;
    border:none;
    border-radius:14px;
    background:linear-gradient(
        135deg,
        var(--primary),
        var(--primary-dark)
    );
    color:white;
    font-size:16px;
    font-weight:600;
    transition:0.3s;
}

.btn-login:hover{
    transform:translateY(-2px);
}

/* ALERT */
.alert{
    border-radius:12px;
    font-size:14px;
}

/* LINK */
.auth-link{
    color:var(--primary-dark);
    font-weight:600;
    text-decoration:none;
}

.auth-link:hover{
    text-decoration:underline;
}

/* EXTRA */
.extra-links{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:15px;
    font-size:14px;
}

/* RESPONSIVE */
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

    .school-title,
    .form-title{
        font-size:1.7rem;
    }
}

@media(max-width:576px){

    .auth-wrapper{
        padding:20px 10px;
    }

    .auth-left,
    .auth-right{
        padding:35px 20px;
    }

    .logo-box img{
        width:145px;
    }

    .form-control,
    .btn-login{
        height:54px;
    }

    .extra-links{
        flex-direction:column;
        gap:10px;
        align-items:flex-start;
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
                Welcome Back
            </h1>

            <p class="school-text">
                Access your VTIB Student Portfolio dashboard,
                manage your projects, showcase your innovations,
                and explore opportunities within the VTIB community.
            </p>

        </div>

        <!-- RIGHT SIDE -->
        <div class="auth-right">

            <h2 class="form-title">
                Student Login
            </h2>

            <p class="form-subtitle">
                Sign in to continue to your account.
            </p>

            <!-- ERROR -->
            <?php if($error): ?>

                <div class="alert alert-danger d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <!-- SUCCESS -->
            <?php if(isset($_GET['success'])): ?>

                <div class="alert alert-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    Registration successful! Please login.
                </div>

            <?php endif; ?>

            <!-- FORM -->
            <form method="POST">

                <!-- EMAIL -->
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
                            required
                        >

                    </div>

                </div>

                <!-- PASSWORD -->
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

                <!-- EXTRA LINKS -->
                <div class="extra-links mb-4">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="remember"
                        >

                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>

                    </div>

                    <a href="#" class="auth-link">
                        Forgot Password?
                    </a>

                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-login w-100">

                    <i class="bi bi-box-arrow-in-right"></i>
                    Login

                </button>

            </form>

            <!-- REGISTER -->
            <div class="text-center mt-4">

                Don't have an account?

                <a href="register.php" class="auth-link">
                    Register here
                </a>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>