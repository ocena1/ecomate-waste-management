<?php
require_once 'db_connect.php';
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing username/password']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(404);
        echo json_encode(['status' => 'not_found', 'username' => $username]);
        exit;
    }

    $verify = password_verify($password, $user['password_hash']);

    // Do not reveal password hashes in real life; this is for debugging only.
    echo json_encode([
        'status' => 'ok',
        'user' => [
            'username' => $user['username'],
            'role' => $user['role'],
            'id' => (int)$user['id'],
        ],
        'password_verify' => $verify,
        'hash_prefix' => substr($user['password_hash'], 0, 10),
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

