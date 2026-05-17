<?php
require_once 'db_connect.php';
require_once 'auth.php';

// Protect admin page
require_admin();

// Handle the update when the user clicks "Update"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE bins SET fill_level = ? WHERE id = ?');
    $stmt->execute([(int)$_POST['fill_level'], (int)$_POST['bin_id']]);
}

$bins = $pdo->query('SELECT * FROM bins ORDER BY id ASC')->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>EcoMate - Admin Controller</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f7f6; }
        .bin-card { background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; }
        input[type="range"] { width: 200px; }
        button { background: #00897b; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #002d5e; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <a href="index.html" class="back-btn">← View Live Map</a>
    <h1>Waste Level Controller</h1>
    <p>Manually adjust bin levels to simulate real-time waste accumulation.</p>

    <?php foreach ($bins as $bin): ?>
    <div class="bin-card">
        <div>
            <strong><?= htmlspecialchars($bin['location_name']) ?></strong><br>
            Current: <?= (int)$bin['fill_level'] ?>%
        </div>
        <form method="POST" style="display: flex; gap: 15px; align-items: center;">
            <input type="hidden" name="bin_id" value="<?= (int)$bin['id'] ?>">
            <input type="range" name="fill_level" min="0" max="100" value="<?= (int)$bin['fill_level'] ?>">
            <button type="submit">Update Level</button>
        </form>
    </div>
    <?php endforeach; ?>

    <script>
        // Optional: Auto-submit when slider moves
        document.querySelectorAll('input[type="range"]').forEach(slider => {
            slider.oninput = function() {
                // No-op: keep manual submit for stability
            };
        });
    </script>
</body>
</html>
