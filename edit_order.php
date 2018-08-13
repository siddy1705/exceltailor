<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 

if($order_id == NULL && $operation == NULL) {
    header('location: orders.php');
    exit();
}


($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $order_id = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('order_id',$order_id);
    $stat = $db->update('et_orders', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Order updated successfully!";
        //Redirect to the listing page,
        header('location: orders.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('order_id', $order_id);
    $order = $db->getOne("et_orders");

    //var_dump($order['customer_id']); die;

    $db->where('customer_id', $order['customer_id']);
    $measurments = $db->get("et_measurments");

    //var_dump($measurments); die;

    $db->where('id', $order['customer_id']);
    $customer_data = $db->getOne("customers");
    $cust_id = $customer_data['id'];
    $phone_number = $customer_data['phone'];
    $cust_name = $customer_data['f_name']." ".$customer_data['l_name'];
    $cust_gender = $customer_data['gender'];
}
?>


<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
<div class="row">
      <div class="col-lg-12"><h2 class="page-header">Update Order</h2></div>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php');
    ?>
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Customer Details</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Measurment Details</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Order Details</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Finalize</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" action="save_order.php" method="POST">
    <?php  include_once './forms/order_form_edit.php'; ?>
    </form>


<!-- Add Measurment Modal -->
<div class="modal fade" id="add_measurment" role="dialog">
    <div class="modal-dialog">
        <form action="" method="POST" id="add_measurment">
        <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Measurment</h4>
            </div>
            <div class="modal-body" style="height:278px;">
                
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Measurment Name</label>
                    <input type="text" class="form-control" placeholder="Enter Measurment Name" id="measurment_name" name="measurment_name"/> 
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">UB A</label>
                    <input type="text" class="form-control" placeholder="Enter UB A" id="ub-a" name="ub-a"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">UB B</label>
                    <input type="text" class="form-control" placeholder="Enter UB B" id="ub-b" name="ub-b"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">LB A</label>
                    <input type="text" class="form-control" placeholder="Enter LB A" id="lb-a" name="lb-a"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">LB B</label>
                    <input type="text" class="form-control" placeholder="Enter LB B" id="lb-b" name="lb-b"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success pull-left" id="save_measurment" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Reset</button>
            </div>
            </div>
        </form>   
    </div>
</div>
<!-- Add Measurment Modal End -->

</div>




<?php include_once 'includes/footer.php'; ?>