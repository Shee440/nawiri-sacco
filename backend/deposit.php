<?php
// Start the session
session_save_path('C:\Users\warima\Desktop\nawiri sacco\sessions');
session_start();

// Include the database connection
require 'database_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the deposit amount
    $amount = filter_var($_POST['deposit_amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $method = $_POST['deposit_method']; // Get the deposit method

    // Validate the amount
    if ($amount <= 0) {
        echo json_encode(['error' => 'Invalid deposit amount']);
        exit;
    }

    // Ensure the deposit method is valid
    $valid_methods = ['mpesa', 'bank_transfer', 'cash', 'cheque'];
    if (!in_array($method, $valid_methods)) {
        echo json_encode(['error' => 'Invalid deposit method']);
        exit;
    }

    // Fetch the user's current balance
    $stmt = $pdo->prepare("SELECT balance FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $current_balance = $user['balance'];

        // Add the deposit to the current balance
        $new_balance = $current_balance + $amount;

        // Update the user's balance in the database
        $stmt = $pdo->prepare("UPDATE users SET balance = ? WHERE user_id = ?");
        if ($stmt->execute([$new_balance, $user_id])) {
            // Insert the transaction into the transactions table
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount, deposit_method) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$user_id, 'deposit', $amount, $method])) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Deposit successful! Your funds will be available shortly.'
                ]);
            } else {
                echo json_encode(['error' => 'Error recording the transaction']);
            }
        } else {
            echo json_encode(['error' => 'Error processing your deposit']);
        }
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
