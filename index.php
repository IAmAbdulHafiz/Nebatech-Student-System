<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main>
    <h2>Dashboard</h2>

    <div class="cards">
        <div class="card">
            <h3>250</h3>
            <p>Total Students</p>
        </div>

        <div class="card">
            <h3>15</h3>
            <p>Courses</p>
        </div>

        <div class="card">
            <h3>12</h3>
            <p>Teachers</p>
        </div>

        <div class="card">
            <h3>98%</h3>
            <p>Attendance</p>
        </div>
    </div>

    <h3>Recent Students</h3>

    <table>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Course</th>
        </tr>

        <tr>
            <td>001</td>
            <td>Abdul-Hafiz</td>
            <td>ICT</td>
        </tr>

        <tr>
            <td>002</td>
            <td>Ali</td>
            <td>Networking</td>
        </tr>
    </table>
</main>

<?php
include 'includes/footer.php';
?>