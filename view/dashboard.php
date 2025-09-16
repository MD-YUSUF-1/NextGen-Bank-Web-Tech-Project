<?php
session_start();
include 'db/db_connect.php'; // DB connection

// Login check
if(!isset($_SESSION['user_id'])){
    header("Location: login.html");
    exit();
}

// User info
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch accounts
$sql = "SELECT * FROM accounts WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$accounts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Banking System</title>
<link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>

<div class="dashboard-header">
    <h1>Welcome, <?php echo $username; ?></h1>
</div>

<div class="dashboard-tiles">
<?php foreach($accounts as $account): ?>
    <div class="tile">
        <h3><?php echo $account['account_type']; ?></h3>
        <p>Account ID: <?php echo $account['account_id']; ?></p>
        <p>Balance: $<?php echo $account['balance']; ?></p>
    </div>
<?php endforeach; ?>
</div>

<div class="quick-actions">
    <a href="Transaction-History.html" class="action-btn">View Transactions</a>
    <a href="loan_applications.html" class="action-btn">Loan Applications</a>
    <a href="#" class="action-btn">Fund Transfer</a>
</div>
<div class="logout">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

</body>
</html>
