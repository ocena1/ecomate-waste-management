<?php
require_once 'db_connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Missing username or password']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password_hash'])) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
        exit;
    }

    $_SESSION['user'] = [
        'id' => (int)$user['id'],
        'username' => $user['username'],
        'role' => $user['role'],
    ];

    echo json_encode(['status' => 'success', 'user' => ['username' => $user['username'], 'role' => $user['role']]]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
}

