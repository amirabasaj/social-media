<?php

session_start();

require '../../database/database.php';
require '../auth/checkAuth_handler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$jsonResponse;
	$json_str = file_get_contents('php://input');
	$data = json_decode($json_str, true);
	if (!empty($data['search_string'])) {

		$search_string= $data['search_string'];
		$query = "select username,profile_pic from users where username like '$search_string%'";
    $result = mysqli_query($conn, $query);
		if ($result) {
      $resArray=array();
      while($row=mysqli_fetch_assoc($result)){

        array_push($resArray,array('username'=>$row['username'],'profile_pic'=>$row['profile_pic']));
        
      }
			$jsonResponse = array('success' => 'YES','data'=>$resArray);
		} else {
			$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
		}
		echo json_encode($jsonResponse);
	}
}