
    
    <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Customer Details</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" id="order-id" value="<?php echo $order['order_id']; ?>" />                             
                <table class="table table-striped table-bordered table-condensed" id="customer-fetch" style="<?php echo ($cust_id != NULL)? '' : 'display:none'; ?>">
                  <?php //if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
                  <thead>
                    <tr>
                      <th>Select</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone</th> 
                    </tr>
                  </thead>
                  <tbody id="customer-table">
                    <tr id="cust_info">
                      
                      <td><input type="radio" name="customer_id" value="<?php echo ($cust_id != NULL) ? $cust_id : '' ?>" <?php echo ($cust_id != NULL) ? 'checked' : '' ?> required></td>
                      <td id="name"><?php echo ($cust_name != NULL) ? $cust_name : '' ?></td>
                      <td id="gender"><?php echo ($cust_gender != NULL) ? $cust_gender : '' ?></td>
                      <td id="phone"><?php echo ($phone_number != NULL) ? $phone_number : '' ?></td>
                    </tr>
                  </tbody>
                  <?php //} ?>
                </table>
                <button class="btn btn-primary nextBtn pull-right" type="button" id="order-form-step2">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Measurment Details</h3>
            </div>
            <div class="panel-body">
            <div class="form-group col-lg-12 col-sm-12 col-sx-12" id="add_new_measurment" >  
                <a href="" class="btn btn-default" style="margin-right: 8px;" data-toggle="modal" data-target="#add_measurment">Add New Measurment </a>
            </div>
            
            <table class="table table-striped table-bordered table-condensed" id="customer-fetch">
                <thead>
                    <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th colspan="6">Measurment</th>
                    </tr>
                </thead>
                <tbody id="measurment-table">
                   <?php 
                    if($edit){
                        foreach($measurments as $measurment) {
                            $checked = ($order['measurment_id'] == $measurment['measurment_id']) ? 'checked' : '';

                            echo '<tr class="measurment-info-'. $measurment['measurment_id'] .'">'
                            . '<td><input type="radio" name="measurment_id" value="'. $measurment['measurment_id'] .'"'.$checked.'></td>'
                            . '<td>'. $measurment['measurment_name'] .'</td>'
                            . '<td colspan="8">'
                            . '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
                            . '<tr><th colspan="8">Upper Body</th></tr>'
                            . '<tr><th>Length</th><th>Chest</th><th>Stomach</th><th>Hip</th>'
                            . '<th>Shoulders</th><th>Sleeves</th><th>Sleeve Round</th><th>Neck</th></tr>'
                            . '</thead>'
                            . '<tbody><tr>'
                            . '<td>'. $measurment['ub_length'] .'</td>'
                            . '<td>'. $measurment['ub_chest'] .'</td>'
                            . '<td>'. $measurment['ub_stomach'] .'</td>'
                            . '<td>'. $measurment['ub_hip'] .'</td>'
                            . '<td>'. $measurment['ub_shoulders'] .'</td>'
                            . '<td>'. $measurment['ub_sleeves'] .'</td>'
                            . '<td>'. $measurment['ub_sleeve_round'] .'</td>'
                            . '<td>'. $measurment['ub_neck'] .'</td>'
                            . '</tr></tbody></table>'
                            . '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
                            . '<tr><th colspan="8">Lower Body</th></tr>'
                            . '<tr><th>Length</th><th>Waist</th><th>Hip</th><th>Thigh</th>'
                            . '<th>Knee</th><th>Bottom</th><th>Inside</th>'
                            . '</thead>'
                            . '<tbody><tr>'
                            . '<td>'. $measurment['lb_length'] .'</td>'
                            . '<td>'. $measurment['lb_waist'] .'</td>'
                            . '<td>'. $measurment['lb_hip'] .'</td>'
                            . '<td>'. $measurment['lb_thigh'] .'</td>'
                            . '<td>'. $measurment['lb_knee'] .'</td>'
                            . '<td>'. $measurment['lb_bottom'] .'</td>'
                            . '<td>'. $measurment['lb_inside'] .'</td>'
                            . '</tr></tbody></table>'
                            . '</td></tr>';
                        }
                    }
                   ?>
                </tbody>
            </table>
                <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Order Details</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-4 col-sm-4 col-sx-4 ">
                    <label class="control-label">Order Type</label>
                    <select class="form-control" id="order-type" name="order_type">
                        <option value="Sherwani" <?php echo ($order['order_type'] == 'Sherwani') ? 'selected="selected"':''; ?>>Sherwani</option>
                        <option value="Kurta" <?php echo ($order['order_type'] == 'Kurta') ? 'selected="selected"':'';   ?>>Kurta</option>
                        <option value="Suit" <?php echo ($order['order_type'] == 'Suit') ? 'selected="selected"':''; ?>>Suit</option>
                        <option value="Formals" <?php echo ($order['order_type'] == 'Formals') ? 'selected="selected"':''; ?>>Formals</option>
                        <option value="Indo-Westren" <?php echo ($order['order_type'] == 'Indo-Westren') ? 'selected="selected"':'';   ?>>Indo-Westren</option>
                        <option value="Pathani" <?php echo ($order['order_type'] == 'Pathani') ? 'selected="selected"':''; ?>>Pathani</option>
                        <option value="Safari" <?php echo ($order['order_type'] == 'Safari') ? 'selected="selected"':''; ?>>Safari</option>
                    </select>
                </div>
                <div class="form-group col-lg-8 col-smtotal-amount-8 col-sx-8">
                    <label class="control-label">Order Title</label>
                    <input maxlength="200" name="order_title" id="order-title" type="text" required="required" class="form-control" placeholder="Enter Order Title" value="<?php echo $order['order_title']; ?>" />
                </div>
                <div class="form-group col-lg-12 col-sm-12 col-sx-12">
                    <label class="control-label">Order Description</label>
                    <textarea name="order_description" placeholder="Enter Order Description" class="form-control" id="address" rows="5"><?php echo $order['order_description']; ?></textarea>
                </div>
                <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Finalize</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Assigned To</label>
                    <select class="form-control" id="assigned-to" name="assigned_to">
                        <?php 
                        foreach($users as $user) {
                            $selected = ($user['id'] == $order['assigned_to']) ? 'selected="selected"':'';
                            echo '<option value="'. $user['id'] .'"'.$selected.'>'. $user['full_name'] .'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Delivery Date</label>
                    <input type="text" required="required" class="form-control" placeholder="Enter Delivery Date" id="delivery-date" name="delivery_date" value="<?php echo $order['delivery_date']; ?>"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Total Amount</label>
                    <input name="total_amount" type="number" required="required" class="form-control" placeholder="Enter Total Amount" id="total-amount" value="<?php echo $order['total_amount']; ?>"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Amount Paid</label>
                    <input name="amount_paid" type="number" required="required" class="form-control" placeholder="Enter Amount Paid" value="<?php echo $order['amount_paid']; ?>"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Order Status</label>
                    <select class="form-control" id="order-status" name="order_status">
                        <option value="Processing" <?php echo ($order['order_status'] == 'Processing') ? 'selected="selected"':''; ?>>Processing</option>
                        <option value="Completed" <?php echo ($order['order_status'] == 'Completed') ? 'selected="selected"':'';   ?>>Completed</option>
                        <option value="Cancelled" <?php echo ($order['order_status'] == 'Cancelled') ? 'selected="selected"':''; ?>>Cancelled</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3 order-buttons">
                <a href="#" class="btn btn-block btn-lg btn-info"><span class="glyphicon glyphicon-send"></span> Send SMS</a>    
                </div>
                <div class="form-group col-lg-3 col-sm-3 col-sx-3 order-buttons">
                <a href="#" class="btn btn-block btn-lg btn-info" id="print-receipt"><span class="glyphicon glyphicon-print"></span> Print Receipt</a>    
                </div>
                <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
                <button class="btn btn-success pull-right" type="submit">Save Order!</button>
            </div>
        </div>
    
