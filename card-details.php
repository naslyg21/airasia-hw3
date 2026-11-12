
<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/validation.php';

// Get the gift card ID from the URL
$cardId = validateCardId($_GET['card_id'] ?? null);

if ($cardId === false || $cardId === null) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Find the selected gift card
$stmt = $pdo->prepare(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD
     WHERE cardId = :cardId'
);

$stmt->execute(['cardId' => $cardId]);
$card = $stmt->fetch();

if (!$card) {
    http_response_code(404);
    exit('Gift card not found.');
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Gift Card Details</h2>

    <div class="gift-card">
        <h3><?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?></h3>

        <p><strong>Card Type:</strong>
            <?= htmlspecialchars($card['cardType'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p><strong>Card Value:</strong>
            $<?= number_format($card['cardValue'], 2) ?>
        </p>

        <p><strong>Points Required:</strong>
            <?= number_format($card['points']) ?>
        </p>

        <a href="card-update.php?card_id=<?= (int)$card['cardId'] ?>" class="btn">
            Update Gift Card
        </a>

        <a href="card-delete.php?card_id=<?= (int)$card['cardId'] ?>" class="btn">
            Delete Gift Card
        </a>
    </div>

    <p>
        <a href="card-list.php" class="btn">Back to Gift Cards</a>
    </p>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
