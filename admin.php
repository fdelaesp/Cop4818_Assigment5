<?php
session_start();

// Must be logged in
if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Auto‐logout after 60 seconds of inactivity
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 60)) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
// update last activity
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Admin</title></head>
<body>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
  <p>This page will auto‐logout after 1 minute of inactivity.</p>
  <form action="logout.php" method="post">
    <button type="submit">Log Out</button>
  </form>
</body>
</html>
