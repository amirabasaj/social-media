<?php

session_start();

require '../../database/database.php';
require '../auth/checkAuth_handler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$jsonResponse;
	$json_str = file_get_contents('php://input');
	$data = json_decode($json_str, true);
	if (!empty($data['post_id'])) {

		$selected_post_id = $data['post_id'];
		$query = "UPDATE posts SET likes = likes + 1	 WHERE post_id ={$selected_post_id} ";
		$result = mysqli_query($conn, $query);
		if ($result) {
			$jsonResponse = array('success' => 'YES');
		} else {
			$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
		}
		echo json_encode($jsonResponse);
	}
}