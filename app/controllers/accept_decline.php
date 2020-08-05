<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}


if (isset($_POST['accept'])) {
	$logged_in = $_SESSION['login_username'];
	$sender = $_POST['sender'];
	$query = "UPDATE follow_req SET status = '1' WHERE getter = '$logged_in' && sender = '$sender' ";
	$accept = mysqli_query($conn, $query);
	if (!$accept) {
		die(mysqli_error($conn));
	}
	$query = "INSERT INTO Follow (follower , followed) VALUES('$sender','$logged_in') ";
	$accept = mysqli_query($conn, $query);
	if (!$accept) {
		die(mysqli_error($conn));
	}
	
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/home.php");
}

if (isset($_POST['decline'])) {

	$logged_in = $_SESSION['login_username'];
	$sender = $_POST['sender'];
	$query = "DELETE FROM follow_req WHERE getter = '$logged_in' && sender = '$sender'  ";
	$decline = mysqli_query($conn, $query);
	if (!$accept) {
		die(mysqli_error($conn));
	}
	
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/home.php");
}