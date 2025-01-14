<?php
session_start();

// If user is not logged in, redirect to login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Event Planner</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: white;
            opacity: 0; /* Initial state for fade-in */
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .content {
            padding: 180px;
            text-align: center;
            background-color: #f9f9f9;
			
        }

        .content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        .content p {
            font-size: 1.2rem;
            color: #666;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .extras {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .extra-box {
            width: 200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .extra-box h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .extra-box p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ . '/php/header.php'; ?>

    <!-- About Us Section -->
    <div class="content">
        <h2>About Us</h2>
        <p>
            Welcome to Event Planner! We are dedicated to helping clubs and organizations 
            plan and manage their events effortlessly. With our platform, you can streamline 
            event organization and foster stronger community connections.
        </p>

        <!-- Extras Section -->
        <div class="extras">
            <div class="extra-box">
                <h3>Feature 1</h3>
                <p>Learn about our key features that make event planning easier.</p>
            </div>
            <div class="extra-box">
                <h3>Feature 2</h3>
                <p>Join our growing community of organizers and participants.</p>
            </div>
            <div class="extra-box">
                <h3>Feature 3</h3>
                <p>Stay connected and updated with our intuitive tools.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/php/footer.php'; ?>
</body>
</html>
