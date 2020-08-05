<?php

session_start();

require '../../database/database.php';
require '../auth/checkAuth_handler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$jsonResponse;
	$json_str = file_get_contents('php://input');
	$data = json_decode($json_str, true);
	if (!empty($data['post_id'])) {

		$logged_in =  $_SESSION['login_username'];
		$selected_post_id = $data['post_id'];
		$queryLikeSelect="SELECT * FROM likes WHERE username='$logged_in' AND postId='$selected_post_id'";
		$resultQueryLikeSelect=mysqli_query($conn,$queryLikeSelect);
		
		if(mysqli_num_rows($resultQueryLikeSelect)>0){
			$queryUpdatePostLikes = "UPDATE posts SET likes = likes -1	 WHERE post_id ='$selected_post_id'";
			$queryLikeDelete="DELETE FROM likes WHERE username='$logged_in' AND postId='$selected_post_id'";
			$resultQueryUpdatePostLikes=mysqli_query($conn,$queryUpdatePostLikes);
			$resultQueryLikeDelete=mysqli_query($conn,$queryLikeDelete);
			if ($resultQueryLikeDelete) {
				$jsonResponse = array('success' => 'YES','color'=>'white');
			} else {
				$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
			}
		}
		else{
			$queryUpdatePostLikes = "UPDATE posts SET likes = likes +1	 WHERE post_id ='$selected_post_id'";
			$queryLikeInsert="INSERT INTO likes (username,postId) VALUES('$logged_in','$selected_post_id')"; 
			$resultQueryUpdatePostLikes=mysqli_query($conn,$queryUpdatePostLikes);
			$resultQueryLikeInsert=mysqli_query($conn,$queryLikeInsert);
			if ($resultQueryLikeInsert) {
				$jsonResponse = array('success' => 'YES','color'=>'red');
			} else {
				$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
			}
		}
		echo json_encode($jsonResponse);
	}
}