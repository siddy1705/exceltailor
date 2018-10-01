<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

if($_SESSION['user_type']!='administrator'){
    header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized");
}

//Get Input data from query string
$from_date = filter_input(INPUT_GET, 'from');
$to_date = filter_input(INPUT_GET, 'to');

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

// Date filter
if($from_date && $to_date) {
    $db->where("o.created_at", $from_date . " 00:00:00", ">");
    $db->where("o.created_at", $to_date . " 23:59:59", "<");
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$db->join("et_customers c", "o.customer_id=c.customer_id", "LEFT");

$orders = $db->arraybuilder()->paginate("et_orders o", $page, $select);
$total_pages = $db->totalPages;


$select_del = array('o.order_id', 'c.f_name', 'c.l_name', 'c.phone', 'o.delivery_date', 'o.created_at', 'o.order_status', 'o.total_amount', 'o.amount_paid', 'o.admin_delivery_verify');

// Date filter
if($from_date && $to_date) {
    $db->where("o.delivery_date", $from_date, ">=");
    $db->where("o.delivery_date", $to_date, "<=");
}

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$db->join("et_customers c", "o.customer_id=c.customer_id", "LEFT");

$orders_del = $db->arraybuilder()->paginate("et_orders o", $page, $select);
$total_pages_del = $db->totalPages;

include_once 'includes/header.php';
?>

<!--Main container start-->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Reports</h1>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for ="input_order">From Date</label>
            <input type="text" class="form-control reports-date" placeholder="Enter From Date" id="from-date" name="from" value="<?php echo $from_date; ?>"/>

            <label for ="input_order">To Date</label>
            <input type="text" class="form-control reports-date" placeholder="Enter To Date" id="to-date" name="to" value="<?php echo $to_date; ?>"/>
            <input type="submit" value="Go" class="btn btn-primary btn-lg">

        </form>
    </div>
<!--   Filter section end-->

    <hr>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Orders Received<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th>Total Amount</th>
                            <th>Pending Amount</th>
                            <th>Order Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $row) : 
                            $pending_amount = $row['total_amount'] - $row['amount_paid'];
                            $d = new DateTime($row['created_at']);
                            $created_date = $d->format('Y-m-d');

                            $db->where('order_id', $row['order_id']);
                            $order_items = $db->getValue ("et_items", "count(*)");
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['f_name']." ".$row['l_name']); ?></td>
                                <td><?php echo $created_date; ?></td>
                                <td><?php echo $order_items; ?></td>
                                <td><?php echo htmlspecialchars($row['total_amount']) ?></td>
                                <td><?php echo $pending_amount; ?> </td>
                                <td><?php echo htmlspecialchars($row['order_status']) ?> </td>
                            </tr>
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
            echo '<li' . $li_class . '><a href="reports.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul></div>';
    }
    ?>
            </div>
		</div>


        
	</div>

    <div class="panel panel-default">
            <div class="panel-heading">Orders Delivered<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th>Total Amount</th>
                            <th>Pending Amount</th>
                            <th>Delivery Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders_del as $row) : 
                            $pending_amount = $row['total_amount'] - $row['amount_paid'];
                            $d = new DateTime($row['created_at']);
                            $created_date = $d->format('Y-m-d');

                            $db->where('order_id', $row['order_id']);
                            $order_items = $db->getValue ("et_items", "count(*)");
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['f_name']." ".$row['l_name']); ?></td>
                                <td><?php echo $created_date; ?></td>
                                <td><?php echo $order_items; ?></td>
                                <td><?php echo htmlspecialchars($row['total_amount']) ?></td>
                                <td><?php echo $pending_amount; ?> </td>
                                <td><?php echo htmlspecialchars($row['delivery_date']) ?> </td>
                            </tr>
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
    if ($total_pages_del > 1) {
        echo '<ul class="pagination text-center">';
        for ($i = 1; $i <= $total_pages_del; $i++) {
            ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
            echo '<li' . $li_class . '><a href="reports.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul></div>';
    }
    ?>
            </div>
		</div>

</div><!--/.row-->



</div>
<!--Main container end-->

</div>




<?php include_once './includes/footer.php'; ?>

