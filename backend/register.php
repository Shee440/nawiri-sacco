<?php
require 'database_connect.php';

// Set the session save path to your custom directory
ini_set('session.save_path', 'C:/Users/warima/Desktop/nawiri sacco/sessions');

// Start the session
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input to prevent XSS
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $balance = 0.00;
    $role = "user";
    $created_at = date("Y-m-d H:i:s");

    // Generate unique account number
    function generateAccountNumber($pdo) {
        do {
            $randomDigits = mt_rand(100000, 999999);
            $accountNumber = "ACC" . $randomDigits;

            // Check if account number already exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE account_number = ?");
            $stmt->execute([$accountNumber]);
            $exists = $stmt->fetchColumn();
        } while ($exists > 0);

        return $accountNumber;
    }

    $account_number = generateAccountNumber($pdo);

    // Check if the email already exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // If email is already taken, display an error message
        echo "Email is already taken.";
    } else {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, balance, role, account_number, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $password, $balance, $role, $account_number, $created_at])) {
            // Optionally store session info
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;

            // Redirect to login page after successful registration
            header("Location:../frontend/login.html");
            exit;
        } else {
            echo "Error registering user.";
        }
    }
}
?>
