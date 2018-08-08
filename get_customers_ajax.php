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
$customer_data = $db->getOne ("customers");
ob_end_clean();

if($customer_data == null) {
  header('HTTP/1.1 500 Internal Server Error');
 } 
else { echo json_encode($customer_data); } ?>

 