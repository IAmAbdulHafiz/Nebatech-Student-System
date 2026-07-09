<?php
require_once 'includes/auth.php';
requireRole(['admin', 'student', 'facilitator']);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Courses</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Duration</th>
        </tr>
        <tr>
            <td>001</td>
            <td>Computer Science</td>
            <td>4 Years</td>
        </tr>
        <tr>
            <td>002</td>
            <td>Networking</td>
            <td>2 Years</td>
        </tr>
        <tr>
            <td>003</td>
            <td>ICT</td>
            <td>1 Year</td>
        </tr>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
