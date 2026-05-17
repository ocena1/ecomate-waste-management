
<?php
require_once 'db_connect.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->query('SELECT * FROM bins ORDER BY id ASC');
    $bins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'bins' => $bins]);
} catch (Exception $e) {
    http_response_code(500);    
    echo json_encode(['status' => 'error', 'message' => 'PHP Error: ' . $e->getMessage()]);
}
