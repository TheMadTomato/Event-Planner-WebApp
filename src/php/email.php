<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_email'])) {
    $subject = $_POST['email_subject'];
    $body = $_POST['email_body'];

    // Fetch all user emails
    $stmt = $pdo->query("SELECT email FROM users");
    $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($emails as $email) {
        mail($email, $subject, $body);
    }
    echo "Emails sent successfully!";
}
?>
