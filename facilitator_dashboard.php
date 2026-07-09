<?php
require_once 'includes/auth.php';
requireRole(['facilitator']);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Facilitator Dashboard</h2>
    <p class="welcome">Welcome, <?php echo htmlspecialchars(currentUserName()); ?>.</p>

    <div class="cards">
        <div class="card">
            <h3>0</h3>
            <p>Assigned Classes</p>
        </div>
        <div class="card">
            <h3>0</h3>
            <p>Students</p>
        </div>
        <div class="card">
            <h3>0</h3>
            <p>Sessions Today</p>
        </div>
        <div class="card">
            <h3>--</h3>
            <p>Attendance Rate</p>
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
