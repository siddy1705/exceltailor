<?php
// ob_start();
require_once './config/config.php';

$db = getDbInstance();

$date_six_month = date('Y-m-01 00:00:00',strtotime("-5 month"));
$date_now = date('d-m-Y');

$db->where("created_at", $date_six_month, '>=');
$results = $db->get('et_orders');

//var_dump($results);

foreach($results as $result) {
    $created_month = date('F', strtotime($result['created_at']));
}


/* for ($i = 0; $i < 6; $i++) {
    echo date(' F Y', strtotime("-$i month"));  
  }
  echo date('01-m-Y',strtotime("-5 month")); */