<?php
session_start();
include 'db/db_connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement (sir er repository style)
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo "<p style='color:red;text-align:center;margin-top:20px;'>Invalid email or password</p>";
    }
} else {
    // If not POST, redirect to login form
    header("Location: login.html");
    exit();
}
?>
