<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
requireRole(['admin']);

$userCount = 0;
$studentCount = 0;
$facilitatorCount = 0;
$adminCount = 0;

$countResult = mysqli_query($conn, "SELECT role, COUNT(*) AS total FROM users GROUP BY role");
if ($countResult) {
    while ($row = mysqli_fetch_assoc($countResult)) {
        $userCount += (int) $row['total'];
        if ($row['role'] === 'student') {
            $studentCount = (int) $row['total'];
        } elseif ($row['role'] === 'facilitator') {
            $facilitatorCount = (int) $row['total'];
        } elseif ($row['role'] === 'admin') {
            $adminCount = (int) $row['total'];
        }
    }
}

$recentUsers = mysqli_query(
    $conn,
    "SELECT full_name, username, role, created_at FROM users ORDER BY created_at DESC LIMIT 5"
);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Admin Dashboard</h2>
    <p class="welcome">Welcome, <?php echo htmlspecialchars(currentUserName()); ?>.</p>

    <div class="cards">
        <div class="card">
            <h3><?php echo $userCount; ?></h3>
            <p>Total Users</p>
        </div>
        <div class="card">
            <h3><?php echo $studentCount; ?></h3>
            <p>Students</p>
        </div>
        <div class="card">
            <h3><?php echo $facilitatorCount; ?></h3>
            <p>Facilitators</p>
        </div>
        <div class="card">
            <h3><?php echo $adminCount; ?></h3>
            <p>Admins</p>
        </div>
    </div>

    <h3>Recent Registrations</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Registered</th>
        </tr>
        <?php if ($recentUsers && mysqli_num_rows($recentUsers) > 0): ?>
            <?php while ($user = mysqli_fetch_assoc($recentUsers)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars(roleLabel($user['role'])); ?></td>
                    <td><?php echo htmlspecialchars(date('M j, Y', strtotime($user['created_at']))); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No users registered yet.</td>
            </tr>
        <?php endif; ?>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
