<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get Input data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$item_type = filter_input(INPUT_GET, 'item_type');
$order_id = filter_input(INPUT_GET, 'order_id');
$employee_id = filter_input(INPUT_GET, 'employee_id');
//$order_by = filter_input(INPUT_GET, 'order_by');

//Get current page.
$page = filter_input(INPUT_GET, 'page');

//Per page limit for pagination.
$pagelimit = 20;

if (!$page) {
    $page = 1;
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('o.order_id', 'c.f_name', 'c.l_name', 'o.delivery_date', 'i.created_at', 'i.item_status', 'i.item_id', 'i.item_type', 'i.item_title', 'u.full_name', 'm.measurment_id', 'm.measurment_name', 'm.ub_length', 'm.ub_chest', 'm.ub_stomach', 'm.ub_hip', 'm.ub_shoulders', 'm.ub_sleeves', 'm.ub_sleeve_round', 'm.ub_neck', 'm.ub_comments', 'm.lb_length', 'm.lb_waist', 'm.lb_hip', 'm.lb_thigh', 'm.lb_knee', 'm.lb_bottom', 'm.lb_inside', 'm.lb_comments');

//Start building query according to input parameters.


// If search string
if ($search_string) 
{
    $db->where('c.f_name', '%' . $search_string . '%', 'like');
    $db->orwhere('c.l_name', '%' . $search_string . '%', 'like');
}

//If order by option selected
if ($item_type && $item_type != "All") { $db->having("i.item_type", $item_type);}

if($order_id) { $db->where("i.order_id", $order_id);}

if($employee_id) { $db->where("i.assigned_to", $employee_id);}

if($_SESSION['user_type'] == "employee") { $db->where("i.assigned_to", $_SESSION["user_id"]);}

// Order by "created_at" in descending order
$db->orderBy("created_at", "Desc");

//Set pagination limit
$db->pageLimit = $pagelimit;

//Get result of the query.
$db->join("et_orders o", "o.order_id=i.order_id", "LEFT");
$db->join("et_customers c", "o.customer_id=c.customer_id", "LEFT");
$db->join("et_users u", "u.id=i.assigned_to", "LEFT");
$db->join("et_new_measurments m", "o.measurment_id=m.measurment_id", "LEFT");

$items = $db->arraybuilder()->paginate("et_items i", $page, $select);
$total_pages = $db->totalPages;

// get columns for order filter
foreach ($items as $value) {
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
            <h1 class="page-header">Items</h1>
        </div>
    </div>
        <?php include('./includes/flash_messages.php') ?>
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo $search_string; ?>" placeholder="Enter Customer Name">
            <label for ="input_order">Item Type</label>
            <select class="form-control" id="item-type" name="item_type" novalidate>
                <option value="All">All</option>
                <option value="Sherwani" <?php echo ($item_type == "Sherwani")?"Selected":""; ?>>Sherwani</option>
                <option value="Sherwani - Kurta" <?php echo ($item_type == "Sherwani - Kurta")?"Selected":""; ?>>Sherwani - Kurta</option>
                <option value="Sherwani - Pajama" <?php echo ($item_type == "Sherwani - Pajama")?"Selected":""; ?>>Sherwani - Pajama</option>
                <option value="Kurta Pajama" <?php echo ($item_type == "Kurta Pajama")?"Selected":""; ?>>Kurta Pajama</option>
                <option value="3 Piece Suit" <?php echo ($item_type == "3 Piece Suit")?"Selected":""; ?>>3 Piece Suit</option>
                <option value="Suit" <?php echo ($item_type == "Suit")?"Selected":""; ?>>Suit</option>
                <option value="Pant" <?php echo ($item_type == "Pant")?"Selected":""; ?>>Pant</option>
                <option value="Shirt" <?php echo ($item_type == "Shirt")?"Selected":""; ?>>Shirt</option>
                <option value="Jodhpuri" <?php echo ($item_type == "Jodhpuri")?"Selected":""; ?>>Jodhpuri</option>
                <option value="Pathani Salwar" <?php echo ($item_type == "Pathani Salwar")?"Selected":""; ?>>Pathani Salwar</option>
                <option value="Safari" <?php echo ($item_type == "Safari")?"Selected":""; ?>>Safari</option>
                <option value="Jackets" <?php echo ($item_type == "Jackets")?"Selected":""; ?>>Jackets</option>
                <option value="Others" <?php echo ($item_type == "Others")?"Selected":""; ?>>Others</option>
            </select>

            <input type="submit" value="Go" class="btn btn-primary btn-lg">

        </form>
    </div>
<!--   Filter section end-->

    <hr>


    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Item Type</th>
                <th>Item Title</th>
                <th>Measurment</th>
                <th>Delivery Date</th>
                <th>Assigned To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $row) : ?>
                <tr>
	                <td><?php echo htmlspecialchars($row['f_name']." ".$row['l_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['item_type']) ?></td>
                    <td><?php echo htmlspecialchars($row['item_title']) ?> </td>
                    <td><a class="btn btn-primary view-measurment" id="view-measurment" data-toggle="modal" data-target="#view-measurment-<?php echo $row['order_id'] ?>">View</a></td>
                    <td><?php echo htmlspecialchars($row['delivery_date']) ?> </td>
                    <td><?php echo htmlspecialchars($row['full_name']) ?> </td>
	                <td>
                        <select class="form-control item-status" id="<?php echo $row['item_id']; ?>" name="item_status" style="height: 40px;">
                            <option value="Pending" <?php echo ($row['item_status'] == 'Pending') ? 'selected="selected"':''; ?>>Pending</option>
                            <option value="Processing" <?php echo ($row['item_status'] == 'Processing') ? 'selected="selected"':''; ?>>Processing</option>
                            <option value="Completed" <?php echo ($row['item_status'] == 'Completed') ? 'selected="selected"':'';   ?>>Completed</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>      
        </tbody>
    </table>

    <?php foreach($items as $row) { ?>
        <!-- Delete Confirmation Modal-->
        <div class="modal fade" id="view-measurment-<?php echo $row['order_id'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title">Measurment Details</h3>
                    </div>
                    <div class="modal-body">
                    <table class="table table-striped table-bordered table-condensed" id="customer-fetch">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th colspan="6">Measurment</th>
                            </tr>
                        </thead>
                        <tbody id="measurment-table">
                          <?php
                            echo '<tr class="measurment-info-'. $row['measurment_id'] .'">'
                            . '<td>'. $row['measurment_name'] .'</td>'
                            . '<td colspan="8">'
                            . '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
                            . '<tr><th colspan="8">Upper Body</th></tr>'
                            . '<tr><th>Length</th><th>Chest</th><th>Stomach</th><th>Hip</th>'
                            . '<th>Shoulders</th><th>Sleeves</th><th>Sleeve Round</th><th>Neck</th></tr>'
                            . '</thead>'
                            . '<tbody><tr>'
                            . '<td>'. $row['ub_length'] .'</td>'
                            . '<td>'. $row['ub_chest'] .'</td>'
                            . '<td>'. $row['ub_stomach'] .'</td>'
                            . '<td>'. $row['ub_hip'] .'</td>'
                            . '<td>'. $row['ub_shoulders'] .'</td>'
                            . '<td>'. $row['ub_sleeves'] .'</td>'
                            . '<td>'. $row['ub_sleeve_round'] .'</td>'
                            . '<td>'. $row['ub_neck'] .'</td>'
                            . '</tr>'
                            . '<tr><th colspan="8">Comments</th></tr>'
                            . '<tr><td colspan="8">' . $row['ub_comments'] . '</td></tr>'
                            . '</tbody></table>'
                            . '<table style="width: 100%;" class="table table-striped table-bordered table-condensed"><thead>'
                            . '<tr><th colspan="8">Lower Body</th></tr>'
                            . '<tr><th>Length</th><th>Waist</th><th>Hip</th><th>Thigh</th>'
                            . '<th>Knee</th><th>Bottom</th><th>Inside</th>'
                            . '</thead>'
                            . '<tbody><tr>'
                            . '<td>'. $row['lb_length'] .'</td>'
                            . '<td>'. $row['lb_waist'] .'</td>'
                            . '<td>'. $row['lb_hip'] .'</td>'
                            . '<td>'. $row['lb_thigh'] .'</td>'
                            . '<td>'. $row['lb_knee'] .'</td>'
                            . '<td>'. $row['lb_bottom'] .'</td>'
                            . '<td>'. $row['lb_inside'] .'</td>'
                            . '</tr>'
                            . '<tr><th colspan="8">Comments</th></tr>'
                            . '<tr><td colspan="8">' . $row['lb_comments'] . '</td></tr>'
                            . '</tbody></table>'
                            . '</td></tr>';
                          ?>
                        </tbody>
                    </table>
                    </div>
                            
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php } ?>


   
    <!--Pagination links-->
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

