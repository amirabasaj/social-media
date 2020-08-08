<?php
require '../auth/checkAuth_handler.php';
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

		$queryDeletePost = "DELETE FROM posts WHERE post_id ='$delete_id' AND username = '$logged_in' ";
		$queryDeletePostLikes = "DELETE FROM likes WHERE postId ='$delete_id'";
		$queryDeleteComments = "DELETE FROM comments WHERE post_id ='$delete_id'";
		$deletepPost = mysqli_query($conn, $queryDeletePost);
		if($deletepPost){
			$deletePostLikes = mysqli_query($conn, $queryDeletePostLikes);
			$deletePostComments = mysqli_query($conn, $queryDeleteComments);	
		}
	}
	$userid = $_SESSION['login_username'] ;
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
}