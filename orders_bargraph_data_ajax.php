<?php
// ob_start();
require_once './config/config.php';

$order_status = $_POST['status'];

$db = getDbInstance();

if($order_status != "All") { $db->where("order_status", $order_status); }

$results = $db->get('et_orders');

foreach($results as $result) {
    $order_type = $result['order_type'];
    $order_type_array[] = $order_type;
}

foreach ($order_type_array as $order_type => $value) {
    $order_array_js[$order_type] = $value;
}

echo json_encode($order_array_js);