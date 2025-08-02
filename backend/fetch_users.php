<?php
// Include database connection
include_once 'database_connect.php';

// Prepare query to fetch user data except for the password
$query = "SELECT user_id, name, email, balance, role, account_number, created_at FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Fetch all users' data
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return user data as JSON
echo json_encode($users);
?>
