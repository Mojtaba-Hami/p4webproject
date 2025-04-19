<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>GameNet</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>GameNet Systems</h1>
    <a href="manage.php" class="manage-btn">Manage Systems</a>
    
    <div class="systems">
        <?php foreach (getComputers() as $computer): ?>
        <div class="system-card">
            <h3><?= $computer['name'] ?></h3>
            <div class="timer" id="timer-<?= $computer['id'] ?>">00:00:00</div>
            <input type="number" id="duration-<?= $computer['id'] ?>" placeholder="Minutes">
            <button onclick="startTimer(<?= $computer['id'] ?>)">Start</button>
            <button onclick="stopTimer(<?= $computer['id'] ?>)">End</button>
            <button onclick="showDetails(<?= $computer['id'] ?>)">Details</button>
        </div>
        <?php endforeach; ?>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>