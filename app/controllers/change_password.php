<?php
require '../auth/checkAuth_handler.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pass_submit'])) {


	global $conn;
	global $logged_in;
	$_SESSION['user_profile']['change_pass'] = "";
  $logged_in =  $_SESSION['login_username'];
  
		if (empty($_POST['old-password']) || empty($_POST['new-password'])) {
      
      $_SESSION['user_profile']['change_pass']="هیچ کدام از فیلد ها نمیتوانند خالی باشند";
		}
		$entered_old_pass = $_POST['old-password'];
		$entered_old_pass = md5($entered_old_pass);
		
		$new_pass = $_POST['new-password'];

		$query = "SELECT password from users WHERE username = '$logged_in' ";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result);
		$user_old_pass = $row['password'];
		
		if ($user_old_pass == $entered_old_pass) {
			echo $logged_in;
			$new_pass = md5($new_pass);
			echo $new_pass;
			$query = "UPDATE users SET password = '$new_pass' WHERE username = '$logged_in' ";
			$update = mysqli_query($conn, $query);
			if (!$update) {
        $_SESSION['user_profile']['change_pass']="مشکل در تغییر رمز";
			}
		}
	}
	$userid = $_SESSION['login_username'] ;
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
	