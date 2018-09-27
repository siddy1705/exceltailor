<?php
ob_start();
require_once './config/config.php';

$item_id = $_POST['itemId'];
$item_status = $_POST['itemStatus'];
// $item_id = 23;

$db = getDbInstance();

//var_dump($item_array); die;

$db->where("item_id", $item_id);
$update_item_status = $db->update("et_items", array("item_status" => $item_status));

// Update Order Status

// Get Order ID
/* $db->where("item_id", $item_id);
$order_id = $db->getValue("et_items", "order_id");

$db->where("order_id", $order_id);
$item_array = $db->get("et_items");

$order_status = "Completed";
$pending_count = 0;

foreach($item_array as $item) {
  $item_status = $item['item_status'];
  if($item_status == "Processing" || $item_status == "Pending") {
    $order_status = "Processing";
  }
  if($item_status == "Pending") {
    $pending_count = $pending_count + 1;
  }
}

if($pending_count == count($item_array)){
  $order_status = "Pending";
}

$db->where("order_id", $order_id);
$db->update("et_orders", array("order_status" => $order_status)); */

ob_end_clean();

echo json_encode($item_array);