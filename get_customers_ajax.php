<?php
ob_start();
require_once './config/config.php';
//require_once './includes/auth_validate.php';

$phone = $_POST['phone'];
//$phone = '34343432';
$db = getDbInstance();
$db->where ("phone", $phone);
$customer = $db->getOne ("customers");
ob_end_clean();
if($customer == null) {
  header('HTTP/1.1 500 Internal Server Error');
  //header('Content-Type: application/json; charset=UTF-8');
  //die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
 } 
else { ?>
<thead>
  <tr>
    <th>Name</th>
    <th>Gender</th>
    <th>Phone</th> 
  </tr>
</thead>
<tbody>
  <tr>
    <!-- <td><?php echo $customer['id'] ?></td> -->
    <input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>" />
    <td><?php echo htmlspecialchars($customer['f_name']." ".$customer['l_name']); ?></td>
    <td><?php echo htmlspecialchars($customer['gender']) ?></td>
    <td><?php echo htmlspecialchars($customer['phone']) ?> </td>
  </tr>
</tbody>
<?php } 
 