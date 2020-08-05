<?php

session_start();

require '../../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$jsonResponse;
	$json_str = file_get_contents('php://input');
	$data = json_decode($json_str, true);
	if (!empty($data['email_address'])) {
    $email_address = $data['email_address'];
    
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '_F@1';
    for ($i = 0; $i < 6; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    } 
    $randomStringHash=md5($randomString);
		$queryUpdatePassword="UPDATE users SET password='$randomStringHash' WHERE email='$email_address'";
		$resultQueryUpdatePassword=mysqli_query($conn,$queryUpdatePassword);
		if($resultQueryUpdatePassword){
			$msg = "Your Password is:".$randomString;
			if(mail("a.ajoodani1375@gmail.com","Reset Password",$msg)){
			
				$jsonResponse = array('success' => 'YES');	
			}
			else{
			
				$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
				
			}
			
		}
		else{
			
			$jsonResponse = array('success' => 'NO', 'error' => 'خطا در بر قراری ارتباط با سرور');
			
		}
		echo json_encode($jsonResponse);
	}
}