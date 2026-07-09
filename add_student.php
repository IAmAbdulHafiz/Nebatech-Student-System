<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
requireRole(['admin']);

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = 'student';

    if ($full_name === '' || $username === '' || $email === '' || $password === '') {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
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
                $success = "Student account created successfully.";
            } else {
                $error = "Could not create student. Please try again.";
            }

            mysqli_stmt_close($insert);
        }

        mysqli_stmt_close($check);
    }
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Add Student</h2>

    <?php if ($error !== ''): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success !== ''): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="POST" action="add_student.php">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" required value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Save Student</button>
        <button type="reset">Reset</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
