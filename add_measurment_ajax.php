<?php
ob_start();
require_once './config/config.php';

$measurment_data = $_POST['measurment_data'];
$customer_id = $_POST['custId'];
foreach($measurment_data as $measurment) {
    switch ($measurment['name']){
        case 'measurment_name':
        $data_to_store['name'] = $measurment['value'];
        break;

        case 'ub-a':
        $data_to_store['ub_a'] = $measurment['value'];
        break;

        case 'ub-b':
        $data_to_store['ub_b'] = $measurment['value'];
        break;

        case 'lb-a':
        $data_to_store['lb_a'] = $measurment['value'];
        break;

        case 'lb-b':
        $data_to_store['lb_b'] = $measurment['value'];
        break;
    }
}

$data_to_store['customer_id'] = $customer_id;
//$data_to_store['created_at'] = date('Y-m-d H:i:s');
$db = getDbInstance();
$last_id = $db->insert ('et_measurments', $data_to_store);

if($last_id) {
    // Return Measurment data
    $db->where ("customer_id", $customer_id);
    $measurment_data = $db->get ("et_measurments");
}
ob_end_clean();

echo json_encode($measurment_data);

 