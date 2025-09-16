<?php

session_start();
// $_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

require_once('../model/cardsModel.php');
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

$userCards = getAllCardsOfUser($id);
echo json_encode(['userCards' => $userCards]);
