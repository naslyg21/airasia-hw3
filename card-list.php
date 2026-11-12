
<?php
require_once __DIR__ . '/includes/db.php';

// Retrieve all gift cards from SQLite
$stmt = $pdo->query(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD
     ORDER BY cardId'
);

$giftCards = $stmt->fetchAll();

// Match original HW2 gift card images
function giftCardImage($name) {
    $images = [
    'amazon' => 'amazon.png',
    'starbucks' => 'starbucks.png',
    'target' => 'target.png',
    'walmart' => 'walmart.png',
    'best buy' => 'bestbuy.png',
    'apple' => 'apple.png',
    'google play' => 'Google Play.png',
    'netflix' => 'Netflix.png',
    'spotify' => 'Spotify.png',
    'uber eats' => 'UberEats.png',
    'uber' => 'UBER.png',
    'airbnb' => 'airbnb.png',
    'sephora' => 'Sephora.png'
];

    foreach ($images as $brand => $file) {
        if (stripos($name, $brand) !== false) {
            return 'images/' . $file;
        }
    }

    return null;
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Available Gift Cards</h2>
    <p>Browse gift cards available for redemption.</p>

    <div class="gift-card-list">
        <?php foreach ($giftCards as $card): ?>
            <div class="gift-card">
                <a href="card-details.php?card_id=<?= (int)$card['cardId'] ?>">
                    <?php $image = giftCardImage($card['cardName']); ?>

                    <?php if ($image !== null): ?>
                        <img
                            src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>"
                        >
                    <?php endif; ?>

                    <h3><?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?></h3>
                </a>

                <p>Points Required: <?= number_format($card['points']) ?></p>
                <p>Value: $<?= number_format($card['cardValue'], 2) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
