<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';
requireRole(['admin', 'facilitator']);

$students = mysqli_query(
    $conn,
    "SELECT id, full_name, username, email, created_at FROM users WHERE role = 'student' ORDER BY created_at DESC"
);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Students List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registered</th>
        </tr>
        <?php if ($students && mysqli_num_rows($students) > 0): ?>
            <?php while ($student = mysqli_fetch_assoc($students)): ?>
                <tr>
                    <td><?php echo (int) $student['id']; ?></td>
                    <td><?php echo htmlspecialchars($student['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['username']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td><?php echo htmlspecialchars(date('M j, Y', strtotime($student['created_at']))); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No students registered yet.</td>
            </tr>
        <?php endif; ?>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
