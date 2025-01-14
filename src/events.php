<?php
require_once __DIR__ . '/php/config.php';
require_once __DIR__ . '/php/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch events from the database
$stmt = $pdo->prepare("SELECT * FROM events ORDER BY date ASC");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle event registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $eventId = intval($_POST['event_id']);
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId) {
        $checkStmt = $pdo->prepare("SELECT * FROM event_registrations WHERE user_id = :user_id AND event_id = :event_id");
        $checkStmt->execute(['user_id' => $userId, 'event_id' => $eventId]);

        if ($checkStmt->rowCount() === 0) {
            $registerStmt = $pdo->prepare("INSERT INTO event_registrations (user_id, event_id) VALUES (:user_id, :event_id)");
            $registerStmt->execute(['user_id' => $userId, 'event_id' => $eventId]);
            $registrationMessage = "You have successfully registered for the event.";
        } else {
            $registrationMessage = "You are already registered for this event.";
        }
    } else {
        $registrationMessage = "You must be logged in to register for an event.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="css/styles.css">
	<style>
		body {
			margin: 0;
			font-family: Arial, sans-serif;
		}
	</style>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        function promptRegistration(eventId) {
            const confirmation = confirm("Do you want to register for this event?");
            if (confirmation) {
                document.getElementById('event-id-input').value = eventId;
                document.getElementById('registration-form').submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    <?php foreach ($events as $event): ?>
                    {
                        title: "<?php echo htmlspecialchars($event['title']); ?>",
                        start: "<?php echo htmlspecialchars($event['date']); ?>",
                        description: "<?php echo htmlspecialchars($event['description'] ?? ''); ?>",
                    },
                    <?php endforeach; ?>
                ],
                eventClick: function (info) {
                    const confirmation = confirm(`Event: ${info.event.title}\nDate: ${info.event.start.toISOString().slice(0, 10)}\nDo you want to register?`);
                    if (confirmation) {
                        document.getElementById('event-id-input').value = info.event.id;
                        document.getElementById('registration-form').submit();
                    }
                }
            });

            calendar.render();
        });
    </script>
</head>
<body>

<?php include 'php/header.php'; ?>

<div class="events-container">
    <h1>Upcoming Events</h1>
    <div class="events-bar">
        <?php foreach ($events as $event): ?>
            <div class="event-card" onclick="promptRegistration(<?php echo $event['id']; ?>)">
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                <p>Date: <?php echo htmlspecialchars($event['date']); ?></p>
                <p>Location: <?php echo htmlspecialchars($event['location']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Calendar Section -->
	<div id="calendar" style="margin: 20px auto; width: 95%;"></div>

</div>

<form id="registration-form" method="POST" action="">
    <input type="hidden" id="event-id-input" name="event_id">
</form>

<?php if (isset($registrationMessage)): ?>
    <div class="registration-message">
        <p><?php echo $registrationMessage; ?></p>
    </div>
<?php endif; ?>

<?php include 'php/footer.php'; ?>

</body>
</html>
