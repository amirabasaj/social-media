<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_POST['unfollow'])) {
	$userid = $_SESSION['userid'];
	$logged_in = $_SESSION['login_username'];
	$query = "DELETE FROM Follow WHERE follower ='$logged_in' && followed ='$userid' ";
	$unfollow = mysqli_query($conn, $query);
	if (!$unfollow) {
		die("Unfollow Failed" . mysqli_error($conn));
	}
	$query = "DELETE FROM follow_req WHERE sender ='$logged_in' && getter ='$userid' ";
	$unfollow = mysqli_query($conn, $query);
	if (!$unfollow) {
		die("Unfollow Failed" . mysqli_error($conn));
	}
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
}

if (isset($_POST['in_progress'])) {
	$userid = $_SESSION['userid'];
	$logged_in = $_SESSION['login_username'];
	$query = "DELETE FROM follow_req WHERE sender ='$logged_in' && getter ='$userid' ";
	$unfollow = mysqli_query($conn, $query);
	if (!$unfollow) {
		die("Unfollow Failed" . mysqli_error($conn));
	}
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
}
