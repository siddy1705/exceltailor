<?php 
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{  
  $customer_data = filter_input_array(INPUT_POST);
}


include_once 'includes/header.php';

$db = getDbInstance();
$users = $db->get('et_users');
?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12"><h2 class="page-header">Add Order</h2></div>
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php');

        include_once './forms/order_form.php'; 
    ?>
  </div>


  <?php include_once 'includes/footer.php'; ?>