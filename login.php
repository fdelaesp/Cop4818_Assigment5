<?php
session_start();

// Redirect logged-in users to admin
if (!empty($_SESSION['user'])) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    // DB connection (adjust host/user/pass as needed)
    $mysqli = new mysqli('localhost', 'root', '', 'login_system');
    if ($mysqli->connect_error) {
        die('DB connection error');
    }

    // Prepare & execute
    $stmt = $mysqli->prepare('SELECT password_hash FROM users WHERE username = ?');
    $stmt->bind_param('s',$u);
    $stmt->execute();
    $stmt->bind_result($hash);
    if ($stmt->fetch() && password_verify($p,$hash)) {
        // Success: record user and timestamp
        $_SESSION['user'] = $u;
        $_SESSION['last_activity'] = time();
        header('Location: admin.php');
        exit;
    } else {
        header('Location: error.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <form method="post" action="login.php">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Log In</button>
  </form>
</body>
</html>
