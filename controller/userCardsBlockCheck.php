<?php
session_start();
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

require_once('../model/cardsModel.php');

$user_card_id = isset($_REQUEST['user_card_id']) ? $_REQUEST['user_card_id'] : '';


$result = blockUserCard($user_card_id);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>