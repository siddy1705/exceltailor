<?php
ob_start();
require_once './config/config.php';

$measurment_data = $_POST['measurment_data'];
$customer_id = $_POST['custId'];
foreach($measurment_data as $measurment) {
    switch ($measurment['name']){
        case 'measurment_name':
        $data_to_store['measurment_name'] = $measurment['value'];
        break;

        case 'ub_length':
        $data_to_store['ub_length'] = $measurment['value'];
        break;

        case 'ub_chest':
        $data_to_store['ub_chest'] = $measurment['value'];
        break;

        case 'ub_stomach':
        $data_to_store['ub_stomach'] = $measurment['value'];
        break;

        case 'ub_hip':
        $data_to_store['ub_hip'] = $measurment['value'];
        break;

        case 'ub_shoulders':
        $data_to_store['ub_shoulders'] = $measurment['value'];
        break;

        case 'ub_sleeves':
        $data_to_store['ub_sleeves'] = $measurment['value'];
        break;

        case 'ub_sleeve_round':
        $data_to_store['ub_sleeve_round'] = $measurment['value'];
        break;

        case 'ub_neck':
        $data_to_store['ub_neck'] = $measurment['value'];
        break;

        case 'ub_comments':
        $data_to_store['ub_comments'] = $measurment['value'];
        break;

        case 'lb_length':
        $data_to_store['lb_length'] = $measurment['value'];
        break;

        case 'lb_waist':
        $data_to_store['lb_waist'] = $measurment['value'];
        break;

        case 'lb_hip':
        $data_to_store['lb_hip'] = $measurment['value'];
        break;

        case 'lb_thigh':
        $data_to_store['lb_thigh'] = $measurment['value'];
        break;

        case 'lb_knee':
        $data_to_store['lb_knee'] = $measurment['value'];
        break;

        case 'lb_bottom':
        $data_to_store['lb_bottom'] = $measurment['value'];
        break;

        case 'lb_inside':
        $data_to_store['lb_inside'] = $measurment['value'];
        break;

        case 'lb_comments':
        $data_to_store['lb_comments'] = $measurment['value'];
        break;

    }
}

$data_to_store['customer_id'] = $customer_id;

$db = getDbInstance();
$last_id = $db->insert ('et_new_measurments', $data_to_store);

if($last_id) {
    // Return Measurment data
    $db->where ("customer_id", $customer_id);
    $measurment_data_new = $db->get ("et_new_measurments");
}
ob_end_clean();

echo json_encode($measurment_data_new);

 