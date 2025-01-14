<?php
require_once 'php/config.php';
require_once 'php/db.php';
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $subscribe = isset($_POST['subscribe']) ? 1 : 0;

    // Validate passwords
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || 
        !preg_match("/[a-z]/", $password) || 
        !preg_match("/\d/", $password) || 
        !preg_match("/[@$!%*?&#]/", $password) || 
        preg_match('/012|123|234|345|456|567|678|789/', $password) ||
        preg_match('/abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz/', strtolower($password))){
        $error_message = "Password must be at least 8 characters, include uppercase, lowercase, a number, a special character, and not include simple sequences like '123' or 'abc'.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Insert into database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, subscribed) VALUES (:name, :email, :password, :subscribed)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password_hash,
                ':subscribed' => $subscribe
            ]);
            header("Location: login.php?signup=success");
            exit();
        } catch (PDOException $e) {
            $error_message = "Email already exists.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Event Planner</title>
  <link rel="stylesheet" href="css/signup.css">
</head>
<body>
  <div class="signup-container">
    <div class="signup-box">
      <h1>Create an Account</h1>
      <p>Join Event Planner today</p>
      <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
      <?php endif; ?>
      <form action="" method="POST">
        <div class="input-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>
        <div class="input-group">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your password" required>
        </div>
       <div class="checkbox-container">
		  <input type="checkbox" name="subscribe" id="subscribe" <?php echo isset($_POST['subscribe']) ? 'checked' : ''; ?>>
		  <label for="subscribe">Subscribe to our mailing list</label>
	   </div>

        <button type="submit" class="btn-primary">Sign Up</button>
      </form>
      <div class="extra-options">
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </div>
    </div>
  </div>
</body>
</html>
