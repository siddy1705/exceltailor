<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
 $db = getDbInstance();

if($_SESSION['user_type']!='administrator'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}

if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $db->where('order_id', $del_id);
    $stat = $db->delete('et_orders');
    var_dump($stat);
    if ($stat) {
        $db->where("order_id", $del_id);
        $db->delete('et_items');
        $_SESSION['info'] = "Order & Items Deleted Successfully!";
        header('location: orders.php');
        exit;
    }
}