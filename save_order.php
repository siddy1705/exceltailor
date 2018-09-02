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

// var_dump($_SESSION);
// die;
$item_data = $_SESSION['item_details_array'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $order_data = filter_input_array(INPUT_POST);
    $data_to_store['order_status'] = 'Pending';
    $data_to_store['customer_id'] = (int)$order_data['customer_id'];
    $data_to_store['measurment_id'] = (int)$order_data['measurment_id'];
    $data_to_store['total_amount'] = (int)$order_data['total_amount'];
    $data_to_store['amount_paid'] = (int)$order_data['amount_paid'];
    $data_to_store['receipt_no'] = (int)$order_data['receipt_no'];
    $data_to_store['delivery_date'] = date('Y-m-d', strtotime($order_data['delivery_date']));

    //var_dump($data_to_store); die;
    $db = getDbInstance();
   
    $last_id = $db->insert ('et_orders', $data_to_store);
    if($last_id)
    {
        //Save Item
        foreach($item_data as $item){
            $item_to_store['order_id'] = $last_id;
            $item_to_store['item_type'] = $item[0];
            $item_to_store['item_quantity'] = (int)$item[1];
            $item_to_store['assigned_to'] = (int)$item[2];
            $item_to_store['item_rate'] = (int)$item[3];
            $item_to_store['item_title'] = $item[4];
            $item_to_store['item_description'] = $item[5];
            $item_to_store['item_amount'] = (int)$item[6];
            $item_to_store['item_status'] = "Pending";
            // $item_to_store['measurment_id'] = (int)$order_data['measurment_id'];

            // var_dump($item_to_store); die;

            $db->insert ('et_items', $item_to_store);
            unset($_SESSION['item_details_array']);
        }

    	$_SESSION['success'] = "New Order Added Successfully!";
    	header('location: orders.php');
    	exit();
    }  
    
}