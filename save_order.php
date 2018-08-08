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
    var_dump($data_to_store); die;
    $db = getDbInstance();
    //Password should be md5 encrypted
    $data_to_store['password'] = md5($data_to_store['password']);
    $last_id = $db->insert ('et_users', $data_to_store);
    if($last_id)
    {
    	$_SESSION['success'] = "Admin user added successfully!";
    	header('location: employees.php');
    	exit();
    }  
    
}