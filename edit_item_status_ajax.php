<?php
ob_start();
require_once './config/config.php';

$item_id = $_POST['itemId'];
$item_status = $_POST['itemStatus'];

$db = getDbInstance();

$db->where("item_id", $item_id);
$update_item_status = $db->update("et_items", array("item_status" => $item_status));
ob_end_clean();

echo json_encode($update_item_status);