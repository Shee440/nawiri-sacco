<?php
// Set session save path to custom directory
session_save_path('C:/Users/warima/Desktop/nawiri sacco/sessions');

// Start the session
session_start();

// Include database connection file
include 'database_connect.php';

// Check if the user is logged in, otherwise return error
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

// Get the user_id from session
$user_id = $_SESSION['user_id'];

try {
    // Fetch user data from users table
    $stmt = $pdo->prepare("SELECT account_number, created_at, balance FROM users WHERE user_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user = $stmt->fetch();

    // Check if user exists
    if ($user) {
        // Return user data as JSON
        echo json_encode([
            'account_number' => $user['account_number'],
            'created_at' => $user['created_at'],
            'balance' => $user['balance']
        ]);
    } else {
        echo json_encode(['error' => 'User data not found']);
    }
} catch (PDOException $e) {
    // If there is an error with the database query
    echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
}
?>
