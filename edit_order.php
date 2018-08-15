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

    //$db->where('id', $order['assigned_to']);
    $users = $db->get("et_users");

    $db->where('customer_id', $order['customer_id']);
    $measurments = $db->get("et_new_measurments");

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
    
    <form role="form" action="" method="POST">
    <?php  include_once './forms/order_form_edit.php'; ?>
    </form>


<!-- Add Measurment Modal -->
<div class="modal fade" id="add_measurment" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="" method="POST" id="add_measurment">
        <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Measurment</h4>
            </div>
            <div class="modal-body" style="height:570px;">
                
                <div class="form-group col-lg-12 col-sm-12 col-sx-12">
                    <label class="control-label">Measurment Name</label>
                    <input type="text" class="form-control" placeholder="Enter Measurment Name" id="measurment_name" name="measurment_name"/> 
                </div>
                
                <h4 style="text-align:center">Upper Body</h4>
                <hr/>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Length</label>
                    <input type="text" class="form-control" placeholder="" id="ub_length" name="ub_length"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Chest</label>
                    <input type="text" class="form-control" placeholder="" id="ub_chest" name="ub_chest"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Stomach</label>
                    <input type="text" class="form-control" placeholder="" id="ub_stomach" name="ub_stomach"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Hip</label>
                    <input type="text" class="form-control" placeholder="" id="ub_hip" name="ub_hip"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Shoulders</label>
                    <input type="text" class="form-control" placeholder="" id="ub_shoulders" name="ub_shoulders"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Sleeves</label>
                    <input type="text" class="form-control" placeholder="" id="ub_sleeves" name="ub_sleeves"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Sleeve Round</label>
                    <input type="text" class="form-control" placeholder="" id="ub_sleeve_round" name="ub_sleeve_round"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Neck</label>
                    <input type="text" class="form-control" placeholder="" id="ub_neck" name="ub_neck"/>
                </div>
               
                <h4 style="text-align:center">Lower Body</h4>
                <hr/>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Length</label>
                    <input type="text" class="form-control" placeholder="" id="lb_length" name="lb_length"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Waist</label>
                    <input type="text" class="form-control" placeholder="" id="lb_waist" name="lb_waist"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Hip</label>
                    <input type="text" class="form-control" placeholder="" id="lb_hip" name="lb_hip"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Thigh</label>
                    <input type="text" class="form-control" placeholder="" id="lb_thigh" name="lb_thigh"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Knee</label>
                    <input type="text" class="form-control" placeholder="" id="lb_knee" name="lb_knee"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Bottom</label>
                    <input type="text" class="form-control" placeholder="" id="lb_bottom" name="lb_bottom"/>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                    <label class="control-label">Inside</label>
                    <input type="text" class="form-control" placeholder="" id="lb_inside" name="lb_inside"/>
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