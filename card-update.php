
<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/validation.php';

// Validate the gift card ID
$cardId = validateCardId($_GET['card_id'] ?? $_POST['card_id'] ?? null);

if ($cardId === false || $cardId === null) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Retrieve the existing gift card
$stmt = $pdo->prepare(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD WHERE cardId = :cardId'
);
$stmt->execute(['cardId' => $cardId]);
$card = $stmt->fetch();

if (!$card) {
    http_response_code(404);
    exit('Gift card not found.');
}

$errors = [];
$data = $card;

// Process submitted changes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['cardName', 'cardType', 'cardValue', 'points'] as $field) {
        $data[$field] = $_POST[$field] ?? '';
    }

    $errors = validateGiftCard($data);

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'UPDATE GIFTCARD
             SET cardName = :cardName,
                 cardType = :cardType,
                 cardValue = :cardValue,
                 points = :points
             WHERE cardId = :cardId'
        );

        $stmt->execute([
            'cardName' => trim($data['cardName']),
            'cardType' => $data['cardType'],
            'cardValue' => (float)$data['cardValue'],
            'points' => (int)$data['points'],
            'cardId' => $cardId
        ]);

        header('Location: card-details.php?card_id=' . $cardId);
        exit;
    }
}

function escape($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Update Gift Card</h2>
    <p>Edit the information below and save your changes.</p>

    <?php if (!empty($errors)): ?>
        <div class="errors" role="alert">
            <h3>Please correct the following:</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= escape($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="card-update.php?card_id=<?= (int)$cardId ?>">
        <input type="hidden" name="card_id" value="<?= (int)$cardId ?>">

        <label for="cardName">Card Name:</label>
        <input type="text" id="cardName" name="cardName"
               maxlength="100"
               value="<?= escape($data['cardName']) ?>" required>

        <label for="cardType">Card Type:</label>
        <select id="cardType" name="cardType" required>
            <?php foreach (['Shopping', 'Food', 'Technology', 'Entertainment', 'Travel'] as $type): ?>
                <option value="<?= escape($type) ?>"
                    <?= $data['cardType'] === $type ? 'selected' : '' ?>>
                    <?= escape($type) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="cardValue">Card Value ($):</label>
        <input type="number" id="cardValue" name="cardValue"
               step="0.01" min="0.01"
               value="<?= escape($data['cardValue']) ?>" required>

        <label for="points">Points Required:</label>
        <input type="number" id="points" name="points"
               step="1" min="1"
               value="<?= escape($data['points']) ?>" required>

        <button type="submit" class="btn">Save Changes</button>
        <a href="card-details.php?card_id=<?= (int)$cardId ?>" class="btn">
            Cancel
        </a>
    </form>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
