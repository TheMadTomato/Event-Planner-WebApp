<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoload

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = $_POST['recipient'] ?? '';  // Single recipient or "broadcast"
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    try {
        $mail = new PHPMailer(true);

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'paulestephan76@gmail.com';
        $mail->Password = 'xaay ucep pbfs csqv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email sender details
        $mail->setFrom('paulestephan76@gmail@gmail.com', 'Event Planner');

        if ($recipient === 'broadcast') {
            // Send to all subscribed users
            require 'db.php'; // Include database connection
            $stmt = $pdo->query("SELECT email FROM subscribers");
            $subscribers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($subscribers as $subscriber) {
                $mail->addAddress($subscriber['email']);
            }
        } else {
            // Send to a single recipient
            $mail->addAddress($recipient);
        }

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = nl2br($message);

        // Send email
        $mail->send();
        header("Location: ../admin-pages/manage-emails.php?success=true");
        exit();
    } catch (Exception $e) {
        header("Location: ../admin-pages/manage-emails.php?error=" . urlencode($mail->ErrorInfo));
        exit();
    }
}
