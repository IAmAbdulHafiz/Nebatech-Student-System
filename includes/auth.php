<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['role']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function requireRole(array $roles): void
{
    requireLogin();

    if (!in_array($_SESSION['role'], $roles, true)) {
        header("Location: dashboard.php");
        exit();
    }
}

function currentUserName(): string
{
    return $_SESSION['full_name'] ?? $_SESSION['username'] ?? 'User';
}

function currentUserRole(): string
{
    return $_SESSION['role'] ?? '';
}

function roleLabel(string $role): string
{
    return match ($role) {
        'admin' => 'Administrator',
        'student' => 'Student',
        'facilitator' => 'Facilitator',
        default => 'User',
    };
}

function dashboardForRole(string $role): string
{
    return match ($role) {
        'admin' => 'admin_dashboard.php',
        'student' => 'student_dashboard.php',
        'facilitator' => 'facilitator_dashboard.php',
        default => 'login.php',
    };
}
