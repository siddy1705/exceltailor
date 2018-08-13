<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
/* if ($_SESSION['user_type'] !== 'administrator') {
    // show permission denied message
    echo 'Permission Denied';
    exit();
} */


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    $data_to_store['order_status'] = 'Processing';
    $data_to_store['customer_id'] = (int)$data_to_store['customer_id'];
    $data_to_store['measurment_id'] = (int)$data_to_store['measurment_id'];
    $data_to_store['total_amount'] = (int)$data_to_store['total_amount'];
    $data_to_store['amount_paid'] = (int)$data_to_store['amount_paid'];
    $data_to_store['delivery_date'] = date('Y-m-d', strtotime($data_to_store['delivery_date']));

    //var_dump($data_to_store); die;
    $db = getDbInstance();
   
    $last_id = $db->insert ('et_orders', $data_to_store);
    if($last_id)
    {
    	$_SESSION['success'] = "New Order Added Successfully!";
    	header('location: orders.php');
    	exit();
    }  
    
}