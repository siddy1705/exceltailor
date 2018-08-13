<?php 
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{  
  $customer_data = filter_input_array(INPUT_POST);
  $cust_id = $customer_data['id'];
  $phone_number = $customer_data['phone'];
  $cust_name = $customer_data['f_name']." ".$customer_data['l_name'];
  $cust_gender = $customer_data['gender'];
}


include_once 'includes/header.php';

$db = getDbInstance();
$users = $db->get('et_users');
?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12"><h2 class="page-header">Add Order</h2></div>
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
    <?php  include_once './forms/order_form.php'; ?>
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