<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}
global $conn;
global $logged_in;

$logged_in =  $_SESSION['login_username'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['submit'])) {
		// if (isset($_POST['post__id'])) {
		$delete_id = $_POST['wanted_id'];

		$query = "DELETE FROM posts WHERE post_id ='$delete_id' AND username = '$logged_in' ";
		$delete_post = mysqli_query($conn, $query);
		echo mysqli_error($conn);
		// $_GET['delete'] = '';
		// }
	}
	$userid = $_SESSION['login_username'] ;
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
}
