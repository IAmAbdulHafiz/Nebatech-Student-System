<?php
require_once 'includes/auth.php';

if (isLoggedIn()) {
    header("Location: " . dashboardForRole(currentUserRole()));
} else {
    header("Location: login.php");
}
exit();
