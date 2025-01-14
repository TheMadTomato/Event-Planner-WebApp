<?php
require_once __DIR__ . '/php/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user is not logged in, redirect to login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Get the logged-in user's name
$userName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #007bff;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: hidden;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .down-arrow {
            font-size: 3rem;
            animation: bounce 2s infinite;
            cursor: pointer;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Fade-out effect */
        .fade-out {
            animation: fadeOut 1s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: scale(1.1);
            }
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $userName; ?></h1>
    <p>Explore Us</p>
    <div class="down-arrow" onclick="navigateToMainPage()">&darr;</div>

    <script>
        function navigateToMainPage() {
            // Add fade-out effect
            document.body.classList.add('fade-out');

            // Wait for the fade-out animation to complete, then navigate
            setTimeout(() => {
                window.location.href = "main.php";
            }, 1000); // Match the animation duration (1s)
        }
    </script>
</body>
</html>
