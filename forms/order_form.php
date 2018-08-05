
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Shipper</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Destination</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Schedule</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Cargo</small></p>
            </div>
        </div>
    </div>
    
    <form role="form">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Customer Details</h3>
            </div>
            <div class="panel-body">               
                <div class="form-group col-lg-6 col-sm-6 col-sx-6">
                <label class="control-label">Enter customer's Mobile Number</label>
									<div class="input-group">
										<input type="number" id="phone-number" class="form-control" required="required" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($customer_data['phone']) : ''?>"><span class="input-group-btn" >
                      <button id="get-customers" class="btn btn-default" type="button" data-original-title="" title="">Search</button>
                  </span></div>
                  
                </div>
                <div class="form-group col-lg-6 col-sm-6 col-sx-6" id="add_new_customer" style="margin-top:30px;">
                  <span class="no-customer">
                  <strong style="color:red">No Customer Found!   </strong>
                  <a href="add_customer.php" class="btn btn-default btn-sm" style="margin-right: 8px;">Add New </span></a>
                  </span>
                
              </div>
                
                <table class="table table-striped table-bordered table-condensed" id="customer-fetch" style="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST')? '' : 'display:none'; ?>">
                  <?php //if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="cust_info">
                      <input type="hidden" name="customer_id" id="cust_id" value="<?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? $customer_data['id'] : '' ?>" />
                      <td id="name"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($customer_data['f_name']." ".$customer_data['l_name']) : '' ?></td>
                      <td id="gender"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($customer_data['gender']) : '' ?></td>
                      <td id="phone"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? htmlspecialchars($customer_data['phone']) : '' ?> </td>
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
            <table class="table table-striped table-bordered table-condensed" id="customer-fetch">
                  <?php //if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
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
                  <tbody id="measurment-table"></tbody>
                  <?php // } ?>
                </table>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Schedule</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Cargo</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Company Name</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Company Address</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address" />
                </div>
                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </form>

