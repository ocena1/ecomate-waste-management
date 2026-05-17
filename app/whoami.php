<?php
require_once 'auth.php';
header('Content-Type: application/json');

$user = current_user();
if (!$user) {
    http_response_code(200);
    echo json_encode(['authenticated' => false]);
    exit;
}

echo json_encode(['authenticated' => true, 'user' => ['username' => $user['username'], 'role' => $user['role']]]);

