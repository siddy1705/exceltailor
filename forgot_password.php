<?php
session_start();
require_once './config/config.php';
//If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) {
    header('Location:dashboard.php');
}

$db = getDbInstance();

$email = filter_input(INPUT_POST, 'email');
//echo $email;
if(isset($email)) {
  $db->where("email", $email);
  $user = $db->getOne("et_users");
  //var_dump($user);
  
  if($user != NULL){
    $token = md5(uniqid(rand(), true));
    $time = strtotime("now");
    $user_id = $user["id"];

    // Insert in DB
    $data_to_store["user_id"] = $user_id;
    $data_to_store["token"] = $token;
    $data_to_store["timestamp"] = $time;
    $last_id = $db->insert ('et_reset_password', $data_to_store);    

		$url = "http://$_SERVER[HTTP_HOST]/reset_password.php?user_id=$user_id&token=$token&time=$time";
		//$url = "http://localhost/exceltailor/reset_password.php?user_id=$user_id&token=$token&time=$time";
		$_SESSION['email_sent'] = "Please check your email for the reset link.";

		$msg = "Please click the following URL to reset your password.\n\n $url";
		mail($email,"Password Reset - Excel Tailor",$msg);
  }
  else {
    $_SESSION['login_failure'] = "Invalid Email Address!";
  }
}




include_once 'includes/header.php';
?>
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Forgot Password</div>
				<div class="panel-body">
        <label>Please Enter Your Email Address</label>
					<form role="form" class="form loginform" method="POST" action="">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Email" name="email" type="email" autofocus="">
							</div>
							<?php
							if(isset($_SESSION['login_failure'])){ ?>
							<div class="alert alert-danger alert-dismissable fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
							</div>
							<?php } ?>
							<?php
							if(isset($_SESSION['email_sent'])){ ?>
							<div class="alert alert-success alert-dismissable fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_SESSION['email_sent']; unset($_SESSION['email_sent']);?>
							</div>
							<?php } ?>
							<!-- <a href="index.html" class="btn btn-primary">Login</a> -->

							<button type="submit" class="btn btn-primary loginField" >Submit</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
<?php include_once 'includes/footer.php'; ?>