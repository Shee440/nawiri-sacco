<?php
// Include database connection
include_once 'database_connect.php';

// Initialize an empty array to hold dashboard info
$dashboard_info = array();

// Fetch total number of user accounts (excluding admins if needed)
$query = "SELECT COUNT(*) as total_accounts FROM users WHERE role = 'user'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dashboard_info['total_accounts'] = $result['total_accounts'];

// Fetch total loan amount from approved loans
$query = "SELECT SUM(amount) as total_loans FROM loans WHERE status = 'active'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dashboard_info['total_loans'] = $result['total_loans'] ?? 0;

// Fetch total deposits
$query = "SELECT SUM(amount) as total_deposits FROM transactions WHERE type = 'deposit'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dashboard_info['total_deposits'] = $result['total_deposits'] ?? 0;

// Fetch number of approved loan applications
$query = "SELECT COUNT(*) as total_approved_loans FROM loan_applications WHERE status = 'approved'";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dashboard_info['loan_approvals'] = $result['total_approved_loans'];

// Return data as JSON
echo json_encode($dashboard_info);
?>
