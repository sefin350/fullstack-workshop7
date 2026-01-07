<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare INSERT statement
    $stmt = $pdo->prepare("INSERT INTO students (student_id, full_name, password_hash) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$student_id, $full_name, $password_hash]);
        header("Location: login.php"); // Redirect to login page
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<h2>Register</h2>
<form method="post">
    Student ID: <input type="text" name="student_id" required><br>
    Full Name: <input type="text" name="full_name" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
