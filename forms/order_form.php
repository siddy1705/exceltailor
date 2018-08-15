
    
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Customer Details</h3>
            </div>
            <div class="panel-body">               
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                <label class="control-label">Enter customer's Name or Mobile Number</label>
                    <div class="input-group">
                        <input type="text" id="phone-number" class="form-control" required="required" value="<?php echo ($phone_number != NULL) ? $phone_number : ''?>">
                        <span class="input-group-btn" >
                            <button id="get-customers" class="btn btn-default" type="button" data-original-title="" title="">Search</button>
                        </span>
                    </div>  
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6" id="add_new_customer" style="margin-top:30px;">
                  <span class="no-customer">
                  <strong style="color:red">No Customer Found!   </strong>
                  <a href="add_customer.php" class="btn btn-default btn-sm" style="margin-right: 8px;">Add New </a>
                  </span>
                </div>

                <div class="form-group col-lg-6 col-sm-6 col-sx-6" id="customer_not_selected" style="margin-top:30px; display:none;">
                  <span class="no-customer">
                  <strong style="color:red">Please select a Customer!   </strong>
                  </span>
                </div>
                
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
            
            <!-- <table class="table table-striped table-bordered table-condensed" id="customer-fetch">
                <thead>
                <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>UB A</th>
                    <th>UB B</th>
                    <th>LB A</th>
                    <th>LB B</th>
                </tr>
                </thead>
                <tbody id="measurment-table">
                    
                </tbody>
            </table> -->

            <table class="table table-striped table-bordered table-condensed" id="customer-fetch">
                <thead>
                <tr>
                    <th rowspan="2">Select</th>
                    <th rowspan="2">Name</th>
                    <th colspan="8">Upper Body</th>
                    <th colspan="7">Lower Body</th>
                </tr>
                <tr>
                    <th>Length</th>
                    <th>Chest</th>
                    <th>Stomach</th>
                    <th>Hip</th>
                    <th>Shoulders</th>
                    <th>Sleeves</th>
                    <th>Sleeve Round</th>
                    <th>Neck</th>
                    <th>Length</th>
                    <th>Waist</th>
                    <th>Hip</th>
                    <th>Thigh</th>
                    <th>Knee</th>
                    <th>Bottom</th>
                    <th>Inside</th>
                </tr>
                </thead>
                <tbody id="measurment-table">
                    
                </tbody>
            </table>
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
                        <option value="Sherwani">Sherwani</option>
                        <option value="Kurta">Kurta</option>
                        <option value="suit">Suit</option>
                        <option value="Formals">Formals</option>
                        <option value="Indo-Westren">Indo-Westren</option>
                        <option value="Pathani">Pathani</option>
                        <option value="Safari">Safari</option>
                    </select>
                </div>
                <div class="form-group col-lg-8 col-smtotal-amount-8 col-sx-8">
                    <label class="control-label">Order Title</label>
                    <input maxlength="200" name="order_title" type="text" required="required" class="form-control" placeholder="Enter Order Title" />
                </div>
                <div class="form-group col-lg-12 col-sm-12 col-sx-12">
                    <label class="control-label">Order Description</label>
                    <textarea name="order_description" placeholder="Enter Order Description" class="form-control" id="address" rows="5"></textarea>
                </div>
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
                            echo '<option value="'. $user['id'] .'">'. $user['full_name'] .'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Delivery Date</label>
                    <input type="text" required="required" class="form-control" placeholder="Enter Delivery Date" id="delivery-date" name="delivery_date"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Total Amount</label>
                    <input name="total_amount" type="number" required="required" class="form-control" placeholder="Enter Total Amount" />
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Amount Paid</label>
                    <input name="amount_paid" type="number" required="required" class="form-control" placeholder="Enter Amount Paid" />
                </div>
                <button class="btn btn-success pull-right" type="submit">Save Order!</button>
            </div>
        </div>
    
