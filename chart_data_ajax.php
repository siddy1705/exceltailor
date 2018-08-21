<?php
// ob_start();
require_once './config/config.php';

$db = getDbInstance();

$date_six_month = date('Y-m-01 00:00:00',strtotime("-5 month"));
$date_now = date('d-m-Y');

$db->where("created_at", $date_six_month, '>=');
$results = $db->get('et_orders');


foreach($results as $result) {
    $created_month = date('F', strtotime($result['created_at']));
    $month_array[] = $created_month;
}

foreach ($month_array as $month => $value) {
    $month_array_js[$month] = $value;
}

echo json_encode($month_array_js);
