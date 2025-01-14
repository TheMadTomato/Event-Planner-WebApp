<?php
session_start();
require __DIR__ . '/php/config.php'; // Include the config file

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}



// Determine the page to load
$page = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
    <style>
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #007bff;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        /* Main content styling */
        .main-content {
            margin-left: 270px; /* Leave space for the sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #007bff; color: white; height: 100vh; padding: 15px;">
        <h2 style="font-family: Arial, sans-serif; font-size: 24px;">Admin Panel</h2>
        <ul style="list-style-type: none; padding: 0; font-family: Arial, sans-serif; font-size: 18px;">
            <li><a href="?page=dashboard">Dashboard</a></li>
            <li><a href="?page=manage-events">Manage Events</a></li>
            <li><a href="?page=manage-emails">Manage Emails</a></li>
			<li><a href="php/logout.php">Logout</a></li>
    </ul>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php
        // Load the requested page
        switch ($page) {
            case 'manage-events':
                include __DIR__ . '/admin-pages/manage-events.php';
                break;
            case 'manage-emails':
                include __DIR__ . '/admin-pages/manage-emails.php';
                break;
            default:
                include __DIR__ . '/admin-pages/dashboard.php';
                break;
        }
        ?>
    </div>
</body>
</html>
