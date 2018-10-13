<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$order_id = filter_input(INPUT_GET, 'order_id');
$action = filter_input(INPUT_GET, 'action');

// if($_SESSION['user_type']!='administrator'){
//     header('HTTP/1.1 401 Unauthorized', true, 401);
//     exit("401 Unauthorized");
// }

$referrer = $_SERVER['HTTP_REFERER'];

$db = getDbInstance();

// Delete a user using user_id
if ($order_id && strpos($referrer, 'orders.php') !== false) {
    $db->where('order_id', $order_id);
    
    $order_update = $db->update("et_orders", array("order_status" => "Completed"));

    if ($order_update) {
        $_SESSION['info'] = "Order Updated successfully!";
        header('location:' . $referrer);
        exit;
    }
}