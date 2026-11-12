
<?php
// HW3: AirAsia Gift Card Validation

function validateGiftCard($data) {
    $errors = [];

    // Validate Card Name
    $cardName = trim((string)($data['cardName'] ?? ''));

    if ($cardName === '') {
        $errors[] = 'Card Name is required.';
    } elseif (strlen($cardName) > 100) {
        $errors[] = 'Card Name must be 100 characters or fewer.';
    }

    // Validate Card Type
    $allowedTypes = [
        'Shopping',
        'Food',
        'Technology',
        'Entertainment',
        'Travel'
    ];

    if (!in_array($data['cardType'] ?? '', $allowedTypes, true)) {
        $errors[] = 'Please select a valid Card Type.';
    }

    // Validate Card Value
    $cardValue = $data['cardValue'] ?? null;

    if (!is_scalar($cardValue) ||
        !is_numeric($cardValue) ||
        !is_finite((float)$cardValue) ||
        (float)$cardValue <= 0) {
        $errors[] = 'Card Value must be a positive number.';
    }

    // Validate Points Required
    $points = filter_var(
        $data['points'] ?? null,
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );

    if ($points === false) {
        $errors[] = 'Points Required must be a positive whole number.';
    }

    return $errors;
}

// Validate a Gift Card ID
function validateCardId($id) {
    return filter_var(
        $id,
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );
}
