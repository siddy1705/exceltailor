
    
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
                      <th>Phone</th> 
                    </tr>
                  </thead>
                  <tbody id="customer-table">
                    <tr id="cust_info">
                      
                      <td><input type="radio" name="customer_id" value="<?php echo ($cust_id != NULL) ? $cust_id : '' ?>" <?php echo ($cust_id != NULL) ? 'checked' : '' ?> required></td>
                      <td id="name"><?php echo ($cust_name != NULL) ? $cust_name : '' ?></td>
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
                <div class="panel panel-success">
                    <div class="panel-heading">Add New Item</div>
                    <div class="panel-body add-item-panel">
                        <div class="form-group col-lg-3 col-sm-3 col-sx-3 ">
                            <label class="control-label">Order Type</label>
                            <select class="form-control" id="order-type" name="order_type" novalidate>
                                <option value="Sherwani">Sherwani</option>
                                <option value="Sherwani - Kurta">Sherwani - Kurta</option>
                                <option value="Sherwani - Pajama">Sherwani - Pajama</option>
                                <option value="Kurta Pajama">Kurta Pajama</option>
                                <option value="3 Piece Suit">3 Piece Suit</option>
                                <option value="Suit">Suit</option>
                                <option value="Pant">Pant</option>
                                <option value="Shirt">Shirt</option>
                                <option value="Jodhpuri">Jodhpuri</option>
                                <option value="Pathani Salwar">Pathani Salwar</option>
                                <option value="Safari">Safari</option>
                                <option value="Jackets">Jackets</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-smtotal-amount-3 col-sx-3">
                            <label class="control-label">Quantity</label>
                            <input name="item_quantity" id="item-quantity" type="number" class="form-control" placeholder="Enter Item Quantity" />
                        </div>
                        <div class="form-group col-lg-3 col-sm-3 col-sx-3">
                            <label class="control-label">Assigned To</label>
                            <select class="form-control" id="assigned-to" name="assigned_to" novalidate>
                                <?php 
                                foreach($users as $user) {
                                    echo '<option value="'. $user['id'] .'">'. $user['full_name'] .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-smtotal-amount-3 col-sx-3">
                            <label class="control-label">Rate</label>
                            <input name="item_rate" id="item-rate" type="number" class="form-control" placeholder="Enter Item Rate" />
                        </div>
                        <div class="form-group col-lg-12 col-smtotal-amount-12 col-sx-12">
                            <label class="control-label">Item Title</label>
                            <input maxlength="200" name="order_title" type="text" id="item-title" class="form-control" placeholder="Enter Item Title" />
                        </div>
                        <div class="form-group col-lg-12 col-sm-12 col-sx-12">
                            <label class="control-label">Item Description</label>
                            <textarea name="order_description" placeholder="Enter Item Description" class="form-control" id="item-desc" rows="3"></textarea>
                        </div>
                        <button class="btn btn-default pull-right" type="button" id="save-item">Save Item</button>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-condensed" id="item_list_table">
                    <thead>
                        <tr>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Assigned To</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="item-list">
                        
                    </tbody>
                </table>
                <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
                <button class="btn btn-primary nextBtn pull-right tempBtn" type="button">Next</button>
                <!-- <button class="btn btn-primary tempBtn" type="button">Temp</button> -->
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Finalize</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Excel Receipt No.</label>
                    <input name="receipt_no" id="receipt_no" type="text" required="required" class="form-control" placeholder="Enter Excel Receipt No" />
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Delivery Date</label>
                    <input type="text" required="required" class="form-control" placeholder="Enter Delivery Date" id="delivery-date" name="delivery_date"/>
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Total Amount</label>
                    <input name="total_amount" id="total-amount" type="number" required="required" class="form-control" placeholder="Enter Total Amount" />
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                    <label class="control-label">Amount Paid</label>
                    <input name="amount_paid" type="number" required="required" class="form-control" placeholder="Enter Amount Paid" />
                </div>
                <button class="btn btn-primary prevBtn pull-left" type="button">Previous</button>
                <button class="btn btn-success pull-right" type="submit">Save Order!</button>
            </div>
        </div>
    
