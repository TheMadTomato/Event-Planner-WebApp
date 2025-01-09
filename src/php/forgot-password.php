<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $reset_link = "http://localhost/Event-Planner-WebApp/reset-password.php?email=" . urlencode($email);
        mail($email, "Password Reset", "Click this link to reset your password: $reset_link");
        echo "Password reset link sent!";
    } else {
        echo "Email not found!";
    }
}
?>
