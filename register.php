<?php

require_once 'includes/auth.php';
require_once 'includes/db.php';

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $allowed_roles = ['admin', 'student', 'facilitator'];

    if ($full_name === '' || $username === '' || $email === '' || $password === '' || $role === '') {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (!in_array($role, $allowed_roles, true)) {
        $error = "Please select a valid role.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
        mysqli_stmt_bind_param($check, "ss", $username, $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $error = "Username or email already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = mysqli_prepare(
                $conn,
                "INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($insert, "sssss", $full_name, $username, $email, $hashed, $role);

            if (mysqli_stmt_execute($insert)) {
                $success = "Registration successful. You can now log in.";
            } else {
                $error = "Registration failed. Please try again.";
            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($check);
    }
}

$selected_role = $_POST['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Nebatech Student System</title>
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
                <p class="auth-tagline">Join as an admin, student, or facilitator and access your role dashboard instantly.</p>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-panel-inner auth-panel-inner--wide">
                <header class="auth-panel-header">
                    <h2>Create account</h2>
                    <p>Register to get started with Nebatech</p>
                </header>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <?php if ($success !== ''): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <form class="auth-form" method="POST" action="register.php">
                    <div class="field-grid">
                        <div class="field">
                            <label for="full_name">Full Name</label>
                            <div class="field-control">
                                <i class="fa fa-id-card" aria-hidden="true"></i>
                                <input type="text" id="full_name" name="full_name" placeholder="Your full name" required value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="field">
                            <label for="username">Username</label>
                            <div class="field-control">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" id="username" name="username" placeholder="Choose a username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <div class="field-control">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <input type="email" id="email" name="email" placeholder="name@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label for="role">Register As</label>
                        <div class="field-control">
                            <i class="fa fa-user-tag" aria-hidden="true"></i>
                            <select id="role" name="role" required>
                                <option value="">Select your role</option>
                                <option value="admin" <?php echo $selected_role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="student" <?php echo $selected_role === 'student' ? 'selected' : ''; ?>>Student</option>
                                <option value="facilitator" <?php echo $selected_role === 'facilitator' ? 'selected' : ''; ?>>Facilitator</option>
                            </select>
                        </div>
                    </div>

                    <div class="field-grid">
                        <div class="field">
                            <label for="password">Password</label>
                            <div class="field-control">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <input type="password" id="password" name="password" placeholder="Min. 6 characters" required>
                            </div>
                        </div>

                        <div class="field">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="field-control">
                                <i class="fa fa-shield-halved" aria-hidden="true"></i>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat password" required>
                            </div>
                        </div>
                    </div>

                    <button class="auth-submit" type="submit">
                        Create Account
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="auth-switch">
                    Already have an account?
                    <a href="login.php">Sign in</a>
                </p>
            </div>
        </section>
    </div>
</body>
</html>
