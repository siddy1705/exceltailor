<?php
// ob_start();
require_once './config/config.php';

$status = $_POST['status'];

$db = getDbInstance();

// Orders Received Today
$d = new DateTime();
$today = $d->format('Y-m-d');
if($status == "created_today") { 
    $db->where("created_at", $today . " 00:00:00", ">");
    $db->where("created_at", $today . " 23:59:59", "<");
    $orders_received_today = $db->get("et_orders");

    $first_order_id = $orders_received_today[0]['order_id'];
    $db->where("order_id", $first_order_id);
    
    for($i = 1; $i < count($orders_received_today); $i++) {
        $db->orwhere("order_id", $orders_received_today[$i]['order_id']);
    }
}

// Pending Orders
if($status == "pending") { $db->where("item_status", "Pending"); }

// Orders Due Today
if($status == "due_today") {
    $db->where("delivery_date", $today);
    $orders_due_today = $db->get("et_orders");

    $first_order_id = $orders_due_today[0]['order_id'];
    $db->where("order_id", $first_order_id);
    
    for($i = 1; $i < count($orders_due_today); $i++) {
        $db->orwhere("order_id", $orders_due_today[$i]['order_id']);
    }
}

$results = $db->get('et_items');

foreach($results as $result) {
    $order_type = $result['item_type'];
    $order_type_array[] = $order_type;
}

foreach ($order_type_array as $order_type => $value) {
    $order_array_js[$order_type] = $value;
}

echo json_encode($order_array_js);