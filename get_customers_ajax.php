<?php
ob_start();
require_once './config/config.php';

$phone = $_POST['phone'];
//$phone = '34343432';
$db = getDbInstance();
//$db->where ("phone", $phone);
$db->where('phone', '%' . $phone . '%', 'like');
$db->orwhere('f_name', '%' . $phone . '%', 'like');
$db->orwhere('l_name', '%' . $phone . '%', 'like');
$customer_data = $db->get ("et_customers");
ob_end_clean();

echo json_encode($customer_data);

 