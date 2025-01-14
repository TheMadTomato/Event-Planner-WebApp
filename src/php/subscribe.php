<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('You need to log in to subscribe!');
        window.location.href = '" . BASE_URL . "login.php';
    </script>";
    exit();
}

$userId = $_SESSION['user_id'];

try {
    // Check if the user is already subscribed
    $stmt = $pdo->prepare("SELECT subscribed FROM users WHERE id = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['subscribed'] == 1) {
        echo "<script>
            alert('You are already subscribed to the mailing list!');
            window.location.href = '" . BASE_URL . "index.php';
        </script>";
        exit();
    }

    // Update the user subscription status
    $updateStmt = $pdo->prepare("UPDATE users SET subscribed = 1 WHERE id = :id");
    $updateStmt->execute(['id' => $userId]);

    echo "<script>
        alert('Thank you for subscribing!');
        window.location.href = '" . BASE_URL . "index.php';
    </script>";
    exit();
} catch (PDOException $e) {
    error_log("Subscription Error: " . $e->getMessage());
    echo "<script>
        alert('An error occurred while subscribing. Please try again later.');
        window.location.href = '" . BASE_URL . "index.php';
    </script>";
    exit();
}
?>
