
<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/validation.php';

// Get and validate the gift card ID
$cardId = validateCardId(
    $_GET['card_id'] ?? $_POST['card_id'] ?? null
);

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

// Only delete after the confirmation form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        'DELETE FROM GIFTCARD WHERE cardId = :cardId'
    );

    $stmt->execute(['cardId' => $cardId]);

    header('Location: card-list.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Delete Gift Card</h2>

    <p>Are you sure you want to delete this gift card?</p>

    <div class="gift-card">
        <h3>
            <?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>
        </h3>

        <p>
            <strong>Card Type:</strong>
            <?= htmlspecialchars($card['cardType'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            <strong>Card Value:</strong>
            $<?= number_format($card['cardValue'], 2) ?>
        </p>

        <p>
            <strong>Points Required:</strong>
            <?= number_format($card['points']) ?>
        </p>
    </div>

    <p><strong>This action cannot be undone.</strong></p>

    <form method="POST" action="card-delete.php">
        <input
            type="hidden"
            name="card_id"
            value="<?= (int)$cardId ?>"
        >

        <button type="submit" class="btn">
            Confirm Delete
        </button>

        <a
            href="card-details.php?card_id=<?= (int)$cardId ?>"
            class="btn"
        >
            Cancel
        </a>
    </form>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
