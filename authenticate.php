<?php 
require_once './config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $remember = filter_input(INPUT_POST, 'remember');
    $password=  md5($password);
   	
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();

    $db->where ("user_name", $username);
    $db->where ("password", $password);
    $row = $db->get('et_users');

    if ($db->count >= 1) {
     
        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['user_type'] = $row[0]['type'];
        $_SESSION['full_name'] = $row[0]['full_name'];
        $_SESSION['user_id'] = $row[0]['id'];
       	if($remember)
       	{
       		setcookie('username',$username , time() + (86400 * 90), "/");
       		setcookie('password',$password , time() + (86400 * 90), "/");
       	}
        header('Location:dashboard.php');
        exit;
    } else {
     
        $_SESSION['login_failure'] = "Invalid user name or password";
        header('Location:login.php');
        exit;
    }
  
}