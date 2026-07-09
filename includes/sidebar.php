<?php
$role = currentUserRole();
?>
<aside>
<ul>
<?php if ($role === 'admin'): ?>
    <li>
        <a href="admin_dashboard.php">
            <i class="fa fa-home"></i>
            Dashboard
        </a>
    </li>
    <li>
        <a href="students.php">
            <i class="fa fa-users"></i>
            Students
        </a>
    </li>
    <li>
        <a href="add_student.php">
            <i class="fa fa-user-plus"></i>
            Add Student
        </a>
    </li>
    <li>
        <a href="courses.php">
            <i class="fa fa-book"></i>
            Courses
        </a>
    </li>
<?php elseif ($role === 'student'): ?>
    <li>
        <a href="student_dashboard.php">
            <i class="fa fa-home"></i>
            Dashboard
        </a>
    </li>
    <li>
        <a href="courses.php">
            <i class="fa fa-book"></i>
            Courses
        </a>
    </li>
<?php elseif ($role === 'facilitator'): ?>
    <li>
        <a href="facilitator_dashboard.php">
            <i class="fa fa-home"></i>
            Dashboard
        </a>
    </li>
    <li>
        <a href="students.php">
            <i class="fa fa-users"></i>
            Students
        </a>
    </li>
    <li>
        <a href="courses.php">
            <i class="fa fa-book"></i>
            Courses
        </a>
    </li>
<?php endif; ?>
</ul>
</aside>
