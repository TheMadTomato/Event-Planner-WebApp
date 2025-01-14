<?php
require_once __DIR__ . '/../php/config.php';
require_once __DIR__ . '/../php/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Validate admin session
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: " . BASE_URL . "login.php");
    exit();
}

// Fetch data for graphs
$stmtUsers = $pdo->prepare("SELECT COUNT(*) as total_users FROM users");
$stmtUsers->execute();
$totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

$stmtSubscribed = $pdo->prepare("SELECT COUNT(*) as subscribed_users FROM users WHERE subscribed = 1");
$stmtSubscribed->execute();
$subscribedUsers = $stmtSubscribed->fetch(PDO::FETCH_ASSOC)['subscribed_users'];

$nonSubscribedUsers = $totalUsers - $subscribedUsers;

$stmtRegistrationData = $pdo->prepare("SELECT DATE(created_at) as reg_date, COUNT(*) as count FROM users GROUP BY reg_date ORDER BY reg_date ASC");
$stmtRegistrationData->execute();
$registrationData = $stmtRegistrationData->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin: 30px;
        }
        .chart-container {
            flex: 1 1 45%;
            max-width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="chart-container">
            <h2>Total Registered Users Over Time</h2>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="chart-container">
            <h2>Subscription Status</h2>
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        // Line Chart: Total Registered Users Over Time
        const registrationData = <?= json_encode($registrationData) ?>;
        const lineLabels = registrationData.map(data => data.reg_date);
        const lineData = registrationData.map(data => data.count);

        const lineChart = new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: lineLabels,
                datasets: [{
                    label: 'Users Registered',
                    data: lineData,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { title: { display: true, text: 'Date' } },
                    y: { title: { display: true, text: 'Number of Registrations' } }
                }
            }
        });

        // Pie Chart: Subscription Status
        const pieChart = new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: ['Subscribed', 'Not Subscribed'],
                datasets: [{
                    label: 'Subscription Status',
                    data: [<?= $subscribedUsers ?>, <?= $nonSubscribedUsers ?>],
                    backgroundColor: ['#28a745', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                }
            }
        });
    </script>
</body>
</html>
