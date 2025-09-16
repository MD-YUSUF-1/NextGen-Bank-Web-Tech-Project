<?php
include 'db/db_connect.php';

$sql = "SELECT * FROM atms";
$result = $conn->query($sql);
$atms = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $atms[] = $row;
    }
}
?>

<div class="atm-container">
    <h1>ATM Locator</h1>

    <div class="atm-tiles">
        <?php foreach($atms as $atm): ?>
            <div class="tile">
                <h3><?php echo $atm['name']; ?></h3>
                <p><strong>Address:</strong> <?php echo $atm['address']; ?>, <?php echo $atm['city']; ?></p>
                <p><strong>Fee:</strong> <?php echo $atm['fee_type']; ?></p>
                <p><strong>Hours:</strong> <?php echo $atm['hours']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="back-button">
        <a href="index.html">← Back to Home</a>
    </div>
</div>

<link rel="stylesheet" href="styles/atm_locator.css">
