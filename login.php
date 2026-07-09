<?php

require_once 'includes/auth.php';

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nebatech Student System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-shell">
        <section class="auth-hero">
            <div class="auth-hero-pattern" aria-hidden="true"></div>
            <div class="auth-hero-content">
                <p class="auth-eyebrow">Student Registration System</p>
                <h1 class="auth-logo">NEBATECH</h1>
                <p class="auth-tagline">Manage learning, students, and courses from one secure portal.</p>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-panel-inner">
                <header class="auth-panel-header">
                    <h2>Welcome back</h2>
                    <p>Sign in to continue to your dashboard</p>
                </header>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form class="auth-form" method="POST" action="authenticate.php">
                    <div class="field">
                        <label for="username">Username or Email</label>
                        <div class="field-control">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input type="text" id="username" name="username" placeholder="Enter username or email" required autofocus>
                        </div>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="field-control">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>

                    <button class="auth-submit" type="submit">
                        Sign In
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="auth-switch">
                    Don't have an account?
                    <a href="register.php">Create one</a>
                </p>
            </div>
        </section>
    </div>
</body>
</html>
