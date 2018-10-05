<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

if($_SESSION['user_type']!='administrator' && $_SESSION['user_type']!='manager'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
$order_status = filter_input(INPUT_GET, 'order_status');
$customer_id = filter_input(INPUT_GET, 'customer_id');
$delivery_due = filter_input(INPUT_GET, 'due');
$delivery_date = filter_input(INPUT_GET, 'delivery_date');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

// If filter types are not selected we show latest created data first
if (!$filter_col) {
    $filter_col = "created_at";
}
if (!$order_by) {
    $order_by = "Desc";
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('o.order_id', 'c.f_name', 'c.l_name', 'c.phone', 'o.delivery_date', 'o.created_at', 'o.order_status', 'o.total_amount', 'o.amount_paid', 'o.admin_delivery_verify');

// default condition
//$db->where("o.admin_delivery_verify", 0);

//Start building query according to input parameters.
// If search string
if ($search_string) 
{
    $db->where('c.f_name', '%' . $search_string . '%', 'like');
    $db->orwhere('c.l_name', '%' . $search_string . '%', 'like');
    $db->orwhere('c.phone', '%' . $search_string . '%', 'like');
}

if ($order_status != "Delivered" && !$customer_id) { $db->where("o.admin_delivery_verify", 0);}

if ($order_status && $order_status != "All") { $db->where("o.order_status", $order_status);}

if($customer_id) { $db->where("o.customer_id", $customer_id); }

if($delivery_date) { $db->where("o.delivery_date", $delivery_date); }

$today = date('Y-m-d');

$d = new DateTime('+1day');
$tomorrow = $d->format('Y-m-d');

if($delivery_due) { 
    if($delivery_due == 'today')
    $db->where("o.delivery_date", $today);

    if($delivery_due == 'tomorrow')
    $db->where("o.delivery_date", $tomorrow); 
}

//If order by option selected
if ($order_by)
{
    $db->orderBy($filter_col, $order_by);
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$db->join("et_customers c", "o.customer_id=c.customer_id", "LEFT");

$orders = $db->arraybuilder()->paginate("et_orders o", $page, $select);
$total_pages = $db->totalPages;

//print_r ($orders); die;

// get columns for order filter
foreach ($orders as $value) {
    foreach ($value as $col_name => $col_value) {
        $filter_options[$col_name] = $col_name;
    }
    //execute only once
    break;
}
include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-6">
            <h1 class="page-header">Orders</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
	            <a href="add_order.php">
	            	<button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add new </button>
	            </a>
            </div>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>">
            <label for ="input_order">Order Status</label>
            <select class="form-control" id="order-sattus" name="order_status" novalidate>
                <option value="All">All</option>
                <option value="Pending" <?php echo ($order_status == "Pending")?"Selected":""; ?>>Pending</option>
                <option value="Processing" <?php echo ($order_status == "Processing")?"Selected":""; ?>>Processing</option>
                <option value="Completed" <?php echo ($order_status == "Completed")?"Selected":""; ?>>Completed</option>
                <option value="Delivered" <?php echo ($order_status == "Delivered")?"Selected":""; ?>>Delivered</option>
                <option value="Cancelled" <?php echo ($order_status == "Cancelled")?"Selected":""; ?>>Cancelled</option>
            </select>
            <label for ="input_order">Delivery Date</label>
            <input type="text" class="form-control" placeholder="Enter Delivery Date" id="delivery-date" name="delivery_date" value="<?php echo $delivery_date; ?>"/>
            <input type="submit" value="Go" class="btn btn-primary btn-lg">

        </form>
    </div>
<!--   Filter section end-->

    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Delivery Date </th>
                <th>Order Status </th>
                <?php if($_SESSION['user_type']=='administrator'){ echo '<th>Pending Amount</th>'; } ?>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $row) : 
                $pending_amount = $row['total_amount'] - $row['amount_paid'];
                ?>
                <tr>
	                <td><?php echo htmlspecialchars($row['f_name']." ".$row['l_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['delivery_date']) ?></td>
                    <td><?php echo htmlspecialchars($row['order_status']) ?> </td>
                    <?php if($_SESSION['user_type']=='administrator'){ ?><td id="pending-amount"><?php echo $pending_amount; ?> </td><?php } ?>
	                <td>
                    <a href="items.php?order_id=<?php echo $row['order_id'] ?>" class="btn btn-success order-actions"><span class="glyphicon glyphicon-eye-open"></span></a>
                    
                    <a href="edit_order.php?order_id=<?php echo $row['order_id'] ?>&operation=edit" class="btn btn-primary order-actions"><span class="glyphicon glyphicon-edit"></span></a>

                    <a class="btn btn-info send-sms order-actions" <?php if($row['order_status'] != "Completed") { echo 'style="display:none"'; } ?> id="<?php echo $row['phone']; ?>"><span class="glyphicon glyphicon-envelope"></span></a>

                    <?php if($_SESSION['user_type']=='administrator'){ if($row['order_status'] == "Delivered" && $row['admin_delivery_verify'] == 0){ ?>
                    <a href="delivery_confirm.php?order_id=<?php echo $row['order_id']; ?>&action=confirm" class="btn btn-info verify-delivery order-actions" id="verify_delivery"><span class="glyphicon glyphicon glyphicon-ok"></span></a>
                    <?php } } ?>

                    <?php if($_SESSION['user_type']=='administrator'){ if($row['order_status'] == "Delivered" && $row['admin_delivery_verify'] == 1){ ?>
                    <a href="delivery_confirm.php?order_id=<?php echo $row['order_id']; ?>&action=unconfirm" class="btn btn-info verify-delivery order-actions" id="verify_delivery"><span class="glyphicon glyphicon glyphicon-remove"></span></a>
                    <?php } } ?>

                    <a href=""  class="btn btn-danger delete_btn order-actions" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                  </td>
                </tr>

						<!-- Delete Confirmation Modal-->
					 <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
					    <div class="modal-dialog">
					      <form action="delete_order.php" method="POST">
					      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Confirm</h4>
						        </div>
						        <div class="modal-body">
						      
						        		<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['order_id'] ?>">
						        	
						          <p>Are you sure you want to delete this customer?</p>
						        </div>
						        <div class="modal-footer">
						        	<button type="submit" class="btn btn-default pull-left">Yes</button>
						         	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						        </div>
						      </div>
					      </form>
					      
					    </div>
  					</div>
            <?php endforeach; ?>      
        </tbody>
    </table>


   
<!--    Pagination links-->
    <div class="text-center">

        <?php
        if (!empty($_GET)) {
            //we must unset $_GET[page] if previously built by http_build_query function
            unset($_GET['page']);
            //to keep the query sting parameters intact while navigating to next/prev page,
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        //Show pagination links
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="orders.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!--    Pagination links end-->

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

