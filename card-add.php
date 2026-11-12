
<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/validation.php';

$errors = [];
$data = [
    'cardName' => '',
    'cardType' => '',
    'cardValue' => '',
    'points' => ''
];

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($data as $field => $default) {
        $data[$field] = $_POST[$field] ?? '';
    }

    $errors = validateGiftCard($data);

    if (empty($errors)) {
        // Save the new gift card using a prepared statement
        $stmt = $pdo->prepare(
            'INSERT INTO GIFTCARD
             (cardName, cardType, cardValue, points)
             VALUES (:cardName, :cardType, :cardValue, :points)'
        );

        $stmt->execute([
            'cardName' => trim($data['cardName']),
            'cardType' => $data['cardType'],
            'cardValue' => (float)$data['cardValue'],
            'points' => (int)$data['points']
        ]);

        header('Location: card-list.php');
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
    <h2>Add Gift Card</h2>
    <p>Enter the information for a new gift card.</p>

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

    <form method="POST" action="card-add.php">
        <label for="cardName">Card Name:</label>
        <input type="text" id="cardName" name="cardName"
               maxlength="100"
               value="<?= escape($data['cardName']) ?>" required>

        <label for="cardType">Card Type:</label>
        <select id="cardType" name="cardType" required>
            <option value="">Select a type</option>
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

        <button type="submit" class="btn">Add Gift Card</button>
        <a href="card-list.php" class="btn">Cancel</a>
    </form>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
