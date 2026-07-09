<?php

require_once 'includes/auth.php';
requireLogin();

header("Location: " . dashboardForRole(currentUserRole()));
exit();
