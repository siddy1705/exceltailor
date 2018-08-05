<?php
ob_start();
require_once './config/config.php';

$cust_id = $_POST['cust_id'];
$db = getDbInstance();
$db->where ("customer_id", $cust_id);
$measurment_data = $db->get ("et_measurments");
ob_end_clean();

if($measurment_data == null) {
  header('HTTP/1.1 500 Internal Server Error');
} 

else { echo json_encode($measurment_data); } ?>

 