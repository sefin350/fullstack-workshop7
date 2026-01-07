<?php
session_start();

// 1 & 2. Check if logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// 3 & 4. Check for theme cookie, default to 'light'
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <style>
        body {
            <?php if ($theme === 'dark') { ?>background-color: #121212;
            color: #ffffff;
            <?php } else { ?>background-color: #ffffff;
            color: #000000;
            <?php } ?>
        }

        a {
            color: <?php echo ($theme == 'dark') ? '#bb86fc' : '#007BFF'; ?>;
            text-decoration: none;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?>!</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="preference.php">Preferences</a>
        <a href="logout.php">Logout</a>
    </nav>

    <p>Your current theme is: <strong><?php echo $theme; ?></strong></p>
</body>

</html>