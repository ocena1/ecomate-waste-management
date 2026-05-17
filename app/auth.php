<?php
// Simple session-based authentication helpers

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login(): void {
    if (empty($_SESSION['user'])) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        exit;
    }
}

function require_admin(): void {
    require_login();
    $role = $_SESSION['user']['role'] ?? null;
    if ($role !== 'admin') {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Forbidden: admin only']);
        exit;
    }
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

