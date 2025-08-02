<?php
// Set custom session path before starting session
session_save_path("C:/Users/warima/Desktop/nawiri sacco/sessions");
session_start();

require 'database_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the amount to withdraw
    $amount = floatval($_POST['amount']);

    // Validate amount
    if ($amount <= 0) {
        echo "Invalid withdrawal amount.";
        exit;
    }

    // Fetch the user's current balance
    $stmt = $pdo->prepare("SELECT balance FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $current_balance = $user['balance'];

        // Check if the user has enough balance
        if ($amount <= $current_balance) {
            // Perform the withdrawal
            $new_balance = $current_balance - $amount;

            // Update the balance in the database
            $stmt = $pdo->prepare("UPDATE users SET balance = ? WHERE user_id = ?");
            if ($stmt->execute([$new_balance, $user_id])) {
                // Insert the transaction into the transactions table
                $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount) VALUES (?, ?, ?)");
                if ($stmt->execute([$user_id, 'withdrawal', $amount])) {
                    echo "Withdrawal successful. Your new balance is: KSh " . number_format($new_balance, 2);
                } else {
                    echo "Error recording the transaction.";
                }
            } else {
                echo "Error processing your withdrawal.";
            }
        } else {
            echo "Insufficient balance.";
        }
    } else {
        echo "User not found.";
    }
}
?>

