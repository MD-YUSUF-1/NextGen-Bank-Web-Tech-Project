<?php
session_start();
include 'db/db_connect.php';

if(isset($_POST['fullName'], $_POST['email'], $_POST['phone'], $_POST['nid'], $_POST['address'], $_POST['password'])) {

    $username = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nid = $_POST['nid'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    
    $profilePicName = null;
    if(isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0){
        $profilePicName = time().'_'.basename($_FILES['profilePic']['name']);
        move_uploaded_file($_FILES['profilePic']['tmp_name'], 'uploads/'.$profilePicName);
    }

   
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    if($stmt->execute()){
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $username;

        
        $sql_acc = "INSERT INTO accounts (user_id, account_type, balance) VALUES (?, 'Savings', 0.00)";
        $stmt_acc = $conn->prepare($sql_acc);
        $stmt_acc->bind_param("i", $user_id);
        $stmt_acc->execute();

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Registration failed!";
    }

} else {
    echo "All fields required!";
}
?>
