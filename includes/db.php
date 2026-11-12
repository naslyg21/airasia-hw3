
<?php
// HW3: AirAsia Rewards Database Connection

try {
    $pdo = new PDO(
        'sqlite:' . __DIR__ . '/../database/rewards.db'
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    die('Unable to connect to the database.');
}
