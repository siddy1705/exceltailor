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

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('customer_id', 'f_name', 'l_name', 'phone','created_at','updated_at');

//Start building query according to input parameters.
// If search string
if ($search_string) 
{
    $db->where('f_name', '%' . $search_string . '%', 'like');
    $db->orwhere('l_name', '%' . $search_string . '%', 'like');
    $db->orwhere('phone', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($order_by)
{
    $db->orderBy($filter_col, $order_by);
}

//Set pagination limit
$db->pageLimit = $pagelimit;

// Order by "created_at" in descending order
$db->orderBy("created_at", "Desc");

//Get result of the query.
$customers = $db->arraybuilder()->paginate("et_customers", $page, $select);
$total_pages = $db->totalPages;

// get columns for order filter
foreach ($customers as $value) {
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
            <h1 class="page-header">Customers</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
	            <a href="add_customer.php?operation=create">
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
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>" placeholder="Enter Customer Name or Mobile Number" style="width: 346px;">
            <input type="submit" value="Go" class="btn btn-primary btn-lg">

        </form>
    </div>
<!--   Filter section end-->

    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <!-- <th class="header">#</th> -->
                <th>Name</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $row) : ?>
                <tr>
	                <!-- <td><?php echo $row['customer_id'] ?></td> -->
	                <td><?php echo htmlspecialchars($row['f_name']." ".$row['l_name']); ?></td>
	                <td><?php echo htmlspecialchars($row['phone']) ?> </td>
	                <td>
                    <form action="add_order.php" method="POST" style="display:inline-block;">
                      <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>" />
                      <input type="hidden" name="f_name" value="<?php echo $row['f_name']; ?>" />
                      <input type="hidden" name="l_name" value="<?php echo $row['l_name']; ?>" />
                      <input type="hidden" name="gender" value="<?php echo $row['gender']; ?>" />
                      <input type="hidden" name="phone" value="<?php echo $row['phone']; ?>" />
                      <button type="submit" class="btn btn-success customer-actions"><span class="glyphicon glyphicon-plus"></span></button>
                    </form>

                    <a href="orders.php?customer_id=<?php echo $row['customer_id'] ?>" class="btn btn-success customer-actions"><span class="glyphicon glyphicon-eye-open"></span></a>
                    
                    <?php if($_SESSION['user_type']!='manager') { ?>
                    <a href="edit_customer.php?customer_id=<?php echo $row['customer_id'] ?>&operation=edit" class="btn btn-primary customer-actions"><span class="glyphicon glyphicon-edit"></span></a>

                    <a href=""  class="btn btn-danger delete_btn customer-actions" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['customer_id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php } ?>
                  </td>
                </tr>

						<!-- Delete Confirmation Modal-->
					 <div class="modal fade" id="confirm-delete-<?php echo $row['customer_id'] ?>" role="dialog">
					    <div class="modal-dialog">
					      <form action="delete_customer.php" method="POST">
					      <!-- Modal content-->
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Confirm</h4>
						        </div>
						        <div class="modal-body">
						      
						        		<input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['customer_id'] ?>">
						        	
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
                echo '<li' . $li_class . '><a href="customers.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
    <!--    Pagination links end-->

</div>
<!--Main container end-->


<?php include_once './includes/footer.php'; ?>

