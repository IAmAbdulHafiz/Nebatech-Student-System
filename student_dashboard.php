<?php
require_once 'includes/auth.php';
requireRole(['student']);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Student Dashboard</h2>
    <p class="welcome">Welcome, <?php echo htmlspecialchars(currentUserName()); ?>.</p>

    <div class="cards">
        <div class="card">
            <h3>0</h3>
            <p>Enrolled Courses</p>
        </div>
        <div class="card">
            <h3>0</h3>
            <p>Assignments Due</p>
        </div>
        <div class="card">
            <h3>--</h3>
            <p>Attendance</p>
        </div>
        <div class="card">
            <h3>--</h3>
            <p>Average Grade</p>
        </div>
    </div>

    <h3>Your Profile</h3>
    <table>
        <tr>
            <th>Full Name</th>
            <td><?php echo htmlspecialchars($_SESSION['full_name']); ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?php echo htmlspecialchars($_SESSION['username']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?php echo htmlspecialchars(roleLabel(currentUserRole())); ?></td>
        </tr>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
