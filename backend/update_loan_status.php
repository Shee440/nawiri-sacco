<?php
require 'database_connect.php';
header('Content-Type: application/json');

// Allow only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);
$loan_id = $input['loan_id'] ?? null;
$status = $input['status'] ?? null;

// Validate
if (!$loan_id || !in_array($status, ['approved', 'rejected'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

try {
    // Update status
    $stmt = $pdo->prepare("UPDATE loan_applications SET status = ? WHERE loan_id = ?");
    $stmt->execute([$status, $loan_id]);

    if ($status === 'approved') {
        // Get loan details
        $stmt = $pdo->prepare("SELECT * FROM loan_applications WHERE loan_id = ?");
        $stmt->execute([$loan_id]);
        $loan = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($loan) {
            // Insert into loans
            $insert = $pdo->prepare("INSERT INTO loans (loan_id, user_id, amount, balance, status) VALUES (?, ?, ?, ?, 'approved')");
            $insert->execute([$loan['loan_id'], $loan['user_id'], $loan['amount'], $loan['amount']]);

            // Update user balance
            $update = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE user_id = ?");
            $update->execute([$loan['amount'], $loan['user_id']]);
        }
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

