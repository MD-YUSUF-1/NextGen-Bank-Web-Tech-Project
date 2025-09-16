<?php

session_start();
// $_SESSION["status"] = true;
if (!isset($_SESSION["status"])) {
    header("location: login.html?error=badrequest");
    exit();
}

require_once('../model/cardsModel.php');
$data = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

// echo $data;
//  exit;


$values = json_decode(($data));
$id = $values->id;

if ($id) {
    
    $card = getCardByID($id);
    $cardFeatures = getCardFeaturesByID($id);
    $cardsVouchrs = getCardVouchersByID($id);
    echo json_encode(['card' => $card , 'features' => $cardFeatures, 'vouchers' => $cardsVouchrs]);
}
