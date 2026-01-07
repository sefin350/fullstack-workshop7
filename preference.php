<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = $_POST['theme'];
    // Set cookie for 30 days
    setcookie('theme', $theme, time() + 86400*30, "/");
    // Refresh page to apply theme immediately
    header("Location: preference.php");
    exit();
}

// Read current theme from cookie or default
$current_theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Preferences</title>
</head>
<body>
    <h2>Theme Preferences</h2>
    <form method="post">
        <label>
            <input type="radio" name="theme" value="light" <?php if ($current_theme=='light') echo 'checked'; ?>>
            Light Mode
        </label><br>
        <label>
            <input type="radio" name="theme" value="dark" <?php if ($current_theme=='dark') echo 'checked'; ?>>
            Dark Mode
        </label><br><br>
        <button type="submit">Save Preferences</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
