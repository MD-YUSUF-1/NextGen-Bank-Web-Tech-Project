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
    <link rel="stylesheet" href="../assets/styles/Font.css">
    <link rel="stylesheet" href="../assets/styles/cardPinManagement.css">
    <title>Change PIN</title>

</head>

<body>
    <div class="container">
        <div class="pin-form">
            <div class="form-header">
                <h2>Change PIN</h2>
                <p>Update your security PIN</p>
            </div>

            <form id="pinForm">
                <div class="form-group">
                    <label for="currentPin">Current PIN</label>
                    <input type="password" id="currentPin" class="pin-input">
                </div>
                <div class="form-group">
                    <label for="newPin">New PIN</label>
                    <input type="password" id="newPin" class="pin-input">
                </div>

                <div class="form-group">
                    <label for="confirmPin">Confirm New PIN</label>
                    <input type="password" id="confirmPin" class="pin-input">
                </div>
                <p id="errorMsg" style="color: red; font-size: 14px;"></p>

                <div class="btn-group">
                    <button type="button" class="btn btn-cancel" onclick="history.back()">Cancel</button>
                    <button type="button" class="btn btn-submit" onclick="validatePin()">Change PIN</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/userPinManagment.js"></script>
</body>

</html>