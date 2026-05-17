<?php
require_once 'db_connect.php';
require_once 'auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit;
}

try {
    $action = $_POST['action'] ?? '';

    // Require admin for all write operations
    require_admin();

    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $lat = $_POST['lat'] ?? null;
        $lng = $_POST['lng'] ?? null;
        $fill = isset($_POST['fill_level']) ? (int)$_POST['fill_level'] : 0;

        if ($name === '' || $lat === null || $lng === null) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
            exit;
        }
        
        // Validate lat/lng are numeric
        if (!is_numeric($lat) || !is_numeric($lng)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Latitude and longitude must be numeric']);
            exit;
        }
        
        if ($fill < 0 || $fill > 100) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'fill_level must be 0-100']);
            exit;
        }

        $sql = 'INSERT INTO bins (location_name, lat, lng, fill_level) VALUES (?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $lat, $lng, $fill]);

        echo json_encode(['status' => 'success', 'message' => 'Bin created']);
        exit;
    }

    if ($action === 'update') {
        $bin_id = (int)($_POST['bin_id'] ?? 0);
        $fill = (int)($_POST['fill_level'] ?? 0);

        if ($bin_id <= 0) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid bin_id']);
            exit;
        }
        if ($fill < 0 || $fill > 100) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'fill_level must be 0-100']);
            exit;
        }

        $stmt = $pdo->prepare('UPDATE bins SET fill_level = ? WHERE id = ?');
        $stmt->execute([$fill, $bin_id]);

        echo json_encode(['status' => 'success', 'message' => 'Bin updated']);
        exit;
    }

    if ($action === 'delete') {
        $bin_id = (int)($_POST['bin_id'] ?? 0);
        if ($bin_id <= 0) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid bin_id']);
            exit;
        }

        $stmt = $pdo->prepare('DELETE FROM bins WHERE id = ?');
        $stmt->execute([$bin_id]);

        echo json_encode(['status' => 'success', 'message' => 'Bin deleted']);
        exit;
    }

    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Unknown action']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Server error: ' . $e->getMessage()]);
}

