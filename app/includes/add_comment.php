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

	if (isset($_POST['add_comment'])) {
		$comment = $_POST['comment'];
		$clicked_post = $_POST['clicked_post'];
		$query = "INSERT INTO comments(username , post_id , comment) VALUES('$logged_in','$clicked_post','$comment')";
		$add_comment = mysqli_query($conn, $query);
		if (!$add_comment) die("FAILED" . mysqli_error($conn));
		$query1 = "UPDATE posts SET comment_counter = comment_counter +1  WHERE post_id = '$clicked_post' ";
		$increase_comment = mysqli_query($conn, $query1);
		if (!$increase_comment) die("FAILED" . mysqli_error($conn));
	}

	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/post_single.php?id=$clicked_post ");
}
