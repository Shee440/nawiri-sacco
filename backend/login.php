<?php
require 'database_connect.php';

// Set custom session path
ini_set('session.save_path', 'C:/Users/warima/Desktop/nawiri sacco/sessions');
session_start();

header('Content-Type: application/json'); // <-- Important

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Match the column names with your database
    $stmt = $pdo->prepare("SELECT user_id, name, password FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $user['name'];

            // ✅ Return JSON success response
            echo json_encode([
                'success' => true,
                'redirect' => '../frontend/dashboard.html'
            ]);
            exit;
        } else {
            // ❌ Return JSON error
            echo json_encode(['error' => 'Invalid email or password.']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'User not found.']);
        exit;
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}
?>
