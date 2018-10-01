<?php
session_start();
require_once './config/config.php';
//If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) {
    header('Location:dashboard.php');
}

$user_id = filter_input(INPUT_GET, 'user_id');
$token = filter_input(INPUT_GET, 'token');
$time = filter_input(INPUT_GET, 'time');
$password_mismatch = false;

$db = getDbInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$password = filter_input(INPUT_POST, 'password');
	$confirm_password = filter_input(INPUT_POST, 'confirm-password');

	if($password != $confirm_password){ $password_mismatch = true; }
	else{
		$db->where('id', $user_id);
		$db_password = md5($password);
		$password_update = $db->update("et_users", array("password" => $db_password));
		if($password_update){
			$_SESSION['password_update'] = "Password Updated successfully!";
    	header('location: login.php');
    	exit();
		}
	}
}

$request_status = true;

$time_20mins = $time + 1200;

$timenow = strtotime("now");

//echo "$time   $timenow   $time_20mins \n";

// if($timenow > $time) {echo "correct time 1";}
// if($timenow < $time_20mins) {echo "correct time 2";}

if(!($timenow > $time && $timenow < $time_20mins)){
  header('HTTP/1.1 401 Unauthorized', true, 401);
    exit("401 Unauthorized (time mismatch)");
}

//echo "$user_id  $token $time";

$db->where("user_id", $user_id);
$db->where("token", $token);
$db->where("timestamp", $time);
$reset = $db->getOne("et_reset_password");

//var_dump($reset);

if($reset == NULL){
  header('HTTP/1.1 401 Unauthorized', true, 401);
    //exit("401 Unauthorized (no data in db)");
    exit();
}
else {

include_once 'includes/header.php';
?>
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Reset Password</div>
				<div class="panel-body">
        <label>Please Enter New Password</label>
					<form role="form" class="form loginform" method="POST" action="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" autofocus="">
							</div>
              <div class="form-group">
								<input class="form-control" placeholder="Confirm Password" name="confirm-password" type="password" autofocus="">
							</div>
							<button type="submit" class="btn btn-primary loginField" >Submit</button>
            </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<?php include_once 'includes/footer.php'; 

}
?>