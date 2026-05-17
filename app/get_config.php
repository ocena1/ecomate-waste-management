<?php
require_once 'config.php';
header('Content-Type: application/json');

// Only return non-sensitive configuration
$response = [
    'google_maps_api_key' => GOOGLE_MAPS_API_KEY,
    'status' => 'success'
];

echo json_encode($response);
?>