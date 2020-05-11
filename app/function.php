<?php

global $wanted_author;
global $wanted_title;
global $wanted_tags;
global $wanted_tagsp;
global $wanted_tage;
global $wanted_tagp;
global $flag;

function confirmQuery($result)
{
	global $conn;
	if ($result) {
		die("Query Failed" . mysqli_error($conn));
	}
}






function limited_echo($x, $length)
{
	if (strlen($x) <= $length) {
		echo $x;
	} else {
		$y = substr($x, 0, $length) . '...';
		echo $y;
	}
}


function separator($media)
{

	$type = substr($media, strpos($media, '.') + 1);
	$type = strtoupper($type);
	$vFormat = array("AVI", "FLV", 'WMV', 'MP4', 'MOV', 'MKV');
	$iFormat = array('JPEG', 'PNG', 'JPG', 'SVG');

	if (in_array($type, $iFormat)) {
		return 0;
	} elseif (in_array($type, $vFormat)) {
		return 1;
	} else {
		return -1;
	}
}

function change_pass(){
				global $conn;
				$logged_in =  $_SESSION['login_username'];
				if (isset($_POST['pass_submit'])) {
				if(empty($_POST['old-password']) || empty($_POST['new-password'])){
				die("هیچ کدام از فیلد ها نمیتوانند خالی باشند") ;
					
				}
				$entered_old_pass = $_POST['old-password'];
				$entered_old_pass = md5($entered_old_pass);
				// echo $old_pass; 
				$new_pass = $_POST['new-password'];

				$query = "SELECT password from users WHERE username = '$logged_in' ";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($result);
				$user_old_pass = $row['password'];
				//  echo $user_old_pass;
			if($user_old_pass == $entered_old_pass ){
				echo $logged_in ;
				$new_pass =md5 ($new_pass);
				echo $new_pass;
				$query = "UPDATE users SET password = '$new_pass' WHERE username = '$logged_in' ";
				$update = mysqli_query ($conn , $query);
				if (!$update){
					die("FAILED" . mysqli_error($conn));
				}

			}
			}
}