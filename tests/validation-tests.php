
<?php
require_once __DIR__ . '/../includes/validation.php';

$passed = 0;
$failed = 0;

function runTest($name, $data, $shouldPass) {
    global $passed, $failed;

    $errors = validateGiftCard($data);
    $actualPass = empty($errors);

    if ($actualPass === $shouldPass) {
        echo "PASS: $name\n";
        $passed++;
    } else {
        echo "FAIL: $name\n";
        $failed++;
    }
}

$validCard = [
    'cardName' => 'Amazon Gift Card',
    'cardType' => 'Shopping',
    'cardValue' => 50,
    'points' => 5000
];

// Test 1: Valid gift card
runTest('Valid gift card', $validCard, true);

// Test 2: Missing card name
runTest('Missing card name',
    array_merge($validCard, ['cardName' => '']),
    false
);

// Test 3: Invalid card type
runTest('Invalid card type',
    array_merge($validCard, ['cardType' => 'Invalid']),
    false
);

// Test 4: Negative card value
runTest('Negative card value',
    array_merge($validCard, ['cardValue' => -25]),
    false
);

// Test 5: Invalid points
runTest('Invalid points',
    array_merge($validCard, ['points' => 0]),
    false
);

echo "\nResults: $passed passed, $failed failed\n";

if ($failed > 0) {
    exit(1);
}
