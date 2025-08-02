<?php
// Set custom session path
ini_set('session.save_path', 'C:/Users/warima/Desktop/nawiri sacco/sessions');
session_start();
                                                                                        

// Include the database connection file
include_once 'database_connect.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];
$purpose = $_POST['purpose'];


// Insert the loan application into the database
$query = "INSERT INTO loan_applications (user_id, amount, purpose, status) VALUES (:user_id, :amount, :purpose, 'pending')";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
$stmt->bindParam(':purpose', $purpose, PDO::PARAM_STR);

if ($stmt->execute()) {
    // Return success response
    echo json_encode(['success' => true]);
} else {
    // Return error response
    echo json_encode(['error' => 'Failed to apply for loan']);
}


