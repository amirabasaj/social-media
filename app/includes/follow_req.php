<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['follow_req'])) {
	$userid = $_SESSION['userid'];
	$logged_in = $_SESSION['login_username'];
	$query = "INSERT INTO follow_req (sender , getter , status ) VALUES ('$logged_in' , '$userid' , '0' )";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Unfollow Failed" . mysqli_error($conn));
	}
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");

}
