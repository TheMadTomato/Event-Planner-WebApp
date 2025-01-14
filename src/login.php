<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or main page
    header("Location: main.php");
    exit();
}

// Handle login form submission
require_once __DIR__ . '/php/config.php';
require_once __DIR__ . '/php/db.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: admin-panel.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                $errorMessage = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $errorMessage = "An error occurred. Please try again later.";
        }
    } else {
        $errorMessage = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
			<meta name="viewport"
			      content="width=device-width, initial-scale=1.0">
				<title>Login - Event Planner</title>
				<link rel="stylesheet"
				      href="css/login.css">
</head>
				<body>
					<div class="login-container">
						<div class="login-box">
							<h1>Welcome Back!</h1>
							<p>Login to your account</p>
      <?php if (isset($error)): ?>
							<p style="color: red;"><?php echo $error; ?>
							</p>
      <?php endif; ?>
							<form action=""
							      method="POST">
								<div class="input-group">
									<label for="email">Email</label>
									<input type="email"
									       id="email"
									       name="email"
									       placeholder="Enter your email"
									       required>
								</div>
								<div
								     class="input-group">
									<label for="password">Password</label>
									<input type="password"
									       id="password"
									       name="password"
									       placeholder="Enter your password"
									       required>
								</div>
								<button
								        type="submit"
								        name="login"
								        class="btn-primary">Login</button>
							</form>
							<div class="extra-options">
								<a href="forgot-password.html">Forgot Password?</a>
								<p>Don’t have an account? <a href="signup.php">Sign up</a>
								</p>
							</div>
						</div>
					</div>
				</body>
			</html>
