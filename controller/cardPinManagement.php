<?php

session_start();
// $_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

require_once('../model/cardsModel.php');
$data = isset($_REQUEST['pinData']) ? $_REQUEST['pinData'] : '';

$pins = json_decode(($data));
$userID= $pins->userID ? $pins->userID : '';
$userCardID= $pins->userCardID ? $pins->userCardID : '';
$currentPin = $pins->currentPin  ? $pins->currentPin : '';
$newPin = $pins->newPin  ? $pins->newPin : '';
$confirmPin = $pins->confirmPin  ? $pins->confirmPin : '';

// echo $userID,$userCardID,$currentPin,$newPin,$confirmPin;
// exit;

$errors = [];

if (strlen($currentPin) === 0 || strlen($newPin) === 0 || strlen($confirmPin) === 0) {
    $errors[] = "All fields are required";
}

if (strlen($newPin) !== 4 || !is_numeric($newPin)) {
    $errors[] = "New PIN must be exactly 4 digits and number";
}
if ($newPin !== $confirmPin) {
    $errors[] = "New PIN and Confirm PIN do not match";
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    exit;
}


$cardInfo = getUserCardDetailsByCardID($userID,$userCardID);
if ($currentPin !== $cardInfo['card_pin']) {
    echo json_encode(["errors" => ["Current PIN is incorrect."]]);
    exit;
}

$pinUpdated = updateUserCardPin($userID,$userCardID,$newPin);
if ($pinUpdated) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["errors" => ["Failed to update PIN"]]);
}




