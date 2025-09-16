<?php
session_start();
// $_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/USerCards.css">
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <title>My Cards - Banking System</title>
    <style>

    </style>
</head>

<body class="container">
    <section>
        <div class="back-container">
            <a href="./Cards.php"><button class="btn back-btn"> <i class="fa-solid fa-arrow-left"></i> Back
                </button></a>
        </div>
    </section>
    <section>
        <p id="success-message" style="display: none;"></p>
    </section>
    <div class="container">
        <div class="header">
            <h1>My Cards</h1>
            <p>Manage your debit and credit cards</p>
        </div>


        <div class="card-section-header">
            <h2 class="section-title">Active Cards (<span id="active-cards-count"></span>)</h2>
            <a href="./Cards.php" class="add-card-btn"> Apply for New Card</a>
        </div>

        <section class="cards-section">
            <div class="cards-grid" id="cardsGrid">

            </div>
        </section>



        <script src="../assets/js/userCards.js"></script>
</body>

</html>