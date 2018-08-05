<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


$user_id=  filter_input(INPUT_GET, 'user_id');
 $db = getDbInstance();
//Serve POST request.  
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // If non-super user accesses this script via url. Stop the exexution
    if($_SESSION['user_type'] !== 'administrator')
    {
        // show permission denied message
        echo 'Permission Denied';
        exit();
    }
    
    // Sanitize input post if we want
    $data_to_update = filter_input_array(INPUT_POST);
    $user_id=  filter_input(INPUT_GET, 'user_id',FILTER_VALIDATE_INT);
    //Encrypting the password
    $data_to_update['password']=md5($data_to_update['password']);
    
    $db->where('id',$user_id);
    $stat = $db->update ('et_users', $data_to_update);
    
    if($stat)
    {
        $_SESSION['success'] = "User has been updated successfully";
    }
    else
    {
        $_SESSION['failure'] = "Failed to update user";
    }

    header('location: employees.php');
    
}


$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
//Select where clause
$db->where('id', $user_id);

$user_account = $db->getOne("et_users");



// Set values to $row

// import header
require_once 'includes/header.php';
?>
<div id="page-wrapper">

    <div class="row">
     <div class="col-lg-12">
            <h2 class="page-header">Update User</h2>
        </div>
        
    </div>
    
    <form class="well form-horizontal" action="" method="post"  id="contact_form" enctype="multipart/form-data">
        <?php include_once './forms/employee_form.php'; ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>