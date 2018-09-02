<?php
ob_start();
require_once './config/config.php';

$item_id = $_POST['itemId'];

$db = getDbInstance();

$db->where('item_id', $item_id);
$delete_item = $db->delete ("et_items");
ob_end_clean();

echo json_encode($delete_item);