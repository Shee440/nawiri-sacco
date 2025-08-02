<?php
// Start the session and specify the session storage path
session_save_path("C:/Users/warima/Desktop/nawiri sacco/sessions");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, return an error
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

// Include the database connection file
include('database_connect.php');

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Prepare the SQL query to fetch the user's balance
$sql = "SELECT balance FROM users WHERE user_id = :user_id LIMIT 1";

// Prepare and execute the query
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the user's balance
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Return the balance as a JSON response
    echo json_encode(["balance" => $user['balance']]);
} else {
    // If no user found, return an error
    echo json_encode(["error" => "User not found"]);
}

?>
