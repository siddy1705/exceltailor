<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
if ($_SESSION['user_type'] !== 'administrator') {
    // show permission denied message
    header('HTTP/1.1 401 Unauthorized', true, 401);
    
    exit("401 Unauthorized");
}
//Get data from query string
$search_string = filter_input(INPUT_GET, 'search_string');
$del_id = filter_input(INPUT_GET, 'del_id');

$filter_col = filter_input(INPUT_GET, 'filter_col');
$order_by = filter_input(INPUT_GET, 'order_by');
$page = filter_input(INPUT_GET, 'page');
$pagelimit = 20;
if ($page == "") {
    $page = 1;
}
// If filter types are not selected we show latest added data first
if ($filter_col == "") {
    $filter_col = "id";
}
if ($order_by == "") {
    $order_by = "desc";
}

//Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$select = array('id', 'full_name', 'user_name', 'type', 'email');

// If user searches 
if ($search_string) {
    $db->where('user_name', '%' . $search_string . '%', 'like');
    $db->orwhere('full_name', '%' . $search_string . '%', 'like');
}


if ($order_by) {
    $db->orderBy($filter_col, $order_by);
}

$db->pageLimit = $pagelimit;
$result = $db->arraybuilder()->paginate("et_users", $page, $select);
$total_pages = $db->totalPages;


// get columns for order filter
foreach ($result as $value) {
    foreach ($value as $col_name => $col_value) {
        $filter_options[$col_name] = $col_name;
    }
    //execute only once
    break;
}


include_once 'includes/header.php';
?>

<div id="page-wrapper">
<div class="row">
     <div class="col-lg-6">
            <h1 class="page-header">Employees</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
            <a href="add_employee.php"> <button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add new</button></a>
            </div>
        </div>
</div>
 <?php include('./includes/flash_messages.php') ?>

    <?php
    if (isset($del_stat) && $del_stat == 1) {
        echo '<div class="alert alert-info">Successfully deleted</div>';
    }
    ?>
    
    <!--    Begin filter section-->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search" >Search</label>
            <input type="text" class="form-control" id="input_search"  name="search_string" value="<?php echo $search_string; ?>">
            
            <input type="submit" value="Go" class="btn btn-primary">

        </form>
    </div>
    <!--   Filter section end-->
    <hr>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">Name</th>
                <th>User Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($result as $row) : ?>
                
            <tr>
                <td><?php echo $row['full_name'] ?></td>
                <td><?php echo htmlspecialchars($row['user_name']) ?></td>
                <td><?php echo htmlspecialchars($row['type']) ?></td>
                <td><?php echo htmlspecialchars($row['email']) ?></td>
                <td>
                    <a href="items.php?employee_id=<?php echo $row['id'] ?>" class="btn btn-success employee-actions" ><span class="glyphicon glyphicon-eye-open"></span></a>

                    <a href="edit_employee.php?user_id=<?php echo $row['id']?>&operation=edit" class="btn btn-primary employee-actions"><span class="glyphicon glyphicon-edit"></span></a>

                    <a href=""  class="btn btn-danger delete_btn employee-actions" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id'] ?>"><span class="glyphicon glyphicon-trash"></span>
                    
                </td>
            </tr>
                <!-- Delete Confirmation Modal-->
                     <div class="modal fade" id="confirm-delete-<?php echo $row['id'] ?>" role="dialog">
                        <div class="modal-dialog">
                          <form action="delete_employee.php" method="POST">
                          <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Confirm</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="del_id" id = "del_id" value="<?php echo $row['id'] ?>">
                                    <p>Are you sure you want to delete this user?</p>
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
            //we must unset $_GET[page] if built by http_build_query function
            unset($_GET['page']);
            $http_query = "?" . http_build_query($_GET);
        } else {
            $http_query = "?";
        }
        if ($total_pages > 1) {
            echo '<ul class="pagination text-center">';
            for ($i = 1; $i <= $total_pages; $i++) {
                ($page == $i) ? $li_class = ' class="active"' : $li_class = "";
                echo '<li' . $li_class . '><a href="dashboard.php' . $http_query . '&page=' . $i . '">' . $i . '</a></li>';
            }
            echo '</ul></div>';
        }
        ?>
    </div>
</div>
<?php include_once 'includes/footer.php'; ?>