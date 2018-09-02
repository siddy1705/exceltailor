<?php
// ob_start();
session_start();
require_once './config/config.php';

// $item_details_array["type"] = $type_array = $_POST['typeArr'];
// $item_details_array["quantity"] = $quantity_array = $_POST['quantityArr'];
// $item_details_array["assignedto"] = $assignedto_array = $_POST['assignedToArr'];
// $item_details_array["title"] = $title_array = $_POST['titleArr'];
// $item_details_array["description"] = $description_array = $_POST['descriptionArr'];
// $item_details_array["rate"] = $rate_array = $_POST['rateArr'];
// $item_details_array["amount"] = $amount_array = $_POST['amountArr'];



$_SESSION['item_details_array'] = $_POST['itemArr'];

echo json_encode($_SESSION['item_details_array']); 