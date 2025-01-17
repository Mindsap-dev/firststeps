<?php
// process_form.php

// Ensure this script only handles POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $data = [
        'age' => $_POST['age'] ?? null,
        'compensation' => $_POST['compensation'] ?? null,
        'increase' => $_POST['increase'] ?? null,
        'retirement_age' => $_POST['retirement_age'] ?? null,
        'match' => $_POST['match'] ?? null,
        'esop_shares' => $_POST['esop_shares'] ?? null,
        'profit_sharing' => $_POST['profit_sharing'] ?? null,
        'non_esop_growth' => $_POST['non_esop_growth'] ?? null,
    ];

    // Validate data if needed
    // Example: Check if required fields are present
    foreach ($data as $key => $value) {
        if (is_null($value)) {
            echo json_encode(['error' => "Missing value for $key"]);
            exit;
        }
    }

    // Respond with JSON-encoded data
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Handle invalid request
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>
