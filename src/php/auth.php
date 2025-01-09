<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Signup Logic
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            echo "Signup successful!";
        } else {
            echo "Error signing up!";
        }
    }

    // Login Logic
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            echo "Login successful!";
        } else {
            echo "Invalid credentials!";
        }
    }
}
?>
