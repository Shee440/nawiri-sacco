<?php
require 'database_connect.php';

$stmt = $pdo->query("SELECT * FROM loan_applications ORDER BY created_at DESC");
$loans = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($loans);
