<?php

session_start();
// $_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

require_once('../model/cardsModel.php');
$data = isset($_REQUEST['values']) ? $_REQUEST['values'] : '';

// echo $data;
//  exit;


$values = json_decode(($data));
$allCards = $values->value;

if ($allCards==="all") {
    
    $allCards = getAllCards();
    $allCardsFeatures = getAllCardsFeatures();
    echo json_encode(['cards' => $allCards , 'features' => $allCardsFeatures]);
}
