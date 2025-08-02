<?php
// Ensure the session is started correctly
ini_set('session.save_path', 'C:/Users/warima/Desktop/nawiri sacco/sessions'); // Define your session path
session_start();

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Secure CSRF token
}

require_once 'database_connect.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}


// Validate and sanitize the input data
$recipient_account = trim($_POST['recipient_account']);
$amount = floatval($_POST['amount']);
$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in session

if (empty($recipient_account) || $amount <= 0) {
    echo json_encode(['error' => 'Invalid input data.']);
    exit;
}

// Check if the recipient account exists
$query = "SELECT * FROM users WHERE account_number = :account_number";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':account_number', $recipient_account);
$stmt->execute();
$recipient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipient) {
    echo json_encode(['error' => 'Recipient account not found.']);
    exit;
}

// Check if the user has enough balance
$query = "SELECT balance FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user_balance = $stmt->fetchColumn();

if ($user_balance < $amount) {
    echo json_encode(['error' => 'Insufficient balance.']);
    exit;
}

// Start the transaction
try {
    $pdo->beginTransaction();

    // Deduct from sender's account
    $query = "UPDATE users SET balance = balance - :amount WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Add to recipient's account
    $query = "UPDATE users SET balance = balance + :amount WHERE user_id = :recipient_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':recipient_id', $recipient['user_id']);
    $stmt->execute();

    // Record the transaction
    $query = "INSERT INTO transactions (user_id, recipient_account, type, amount, created_at) 
              VALUES (:user_id, :recipient_account, 'transfer', :amount, NOW())";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipient_account', $recipient_account);
    $stmt->bindParam(':amount', $amount);
    $stmt->execute();

    // Commit the transaction
    $pdo->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['error' => 'An error occurred, please try again.']);
}