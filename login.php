<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // Get stored hash from database
    $stmt = $pdo->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->execute([$student_id]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['student_name'] = $user['full_name'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid Student ID or Password!";
    }
}
?>

<h2>Login</h2>
<form method="post">
    Student ID: <input type="text" name="student_id" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
