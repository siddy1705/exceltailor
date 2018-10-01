<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Only super admin is allowed to access this page
if ($_SESSION['user_type'] !== 'administrator') {
    // show permission denied message
    echo 'Permission Denied';
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$data_to_store = filter_input_array(INPUT_POST);
    $db = getDbInstance();
    //Password should be md5 encrypted
    $data_to_store['password'] = md5($data_to_store['password']);
    $last_id = $db->insert ('et_users', $data_to_store);
    if($last_id)
    {
    	$_SESSION['success'] = "User added successfully!";
    	header('location: employees.php');
    	exit();
    }  
    
}

$edit = false;


require_once 'includes/header.php';
?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">Add User</h2>
		</div>
	</div>
	<!-- Success message -->
	<form class="well form-horizontal" action=" " method="post"  id="contact_form" enctype="multipart/form-data">
		<?php include_once './forms/employee_form.php'; ?>
	</form>
</div>




<?php include_once 'includes/footer.php'; ?>