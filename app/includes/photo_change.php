<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	global $conn;
	global $logged_in;
	$logged_in =  $_SESSION['login_username'];
	// echo $logged_in;
	if (isset($_POST['upload-image'])) {
		$test = $_POST['upload-image'];
		// global $logged_in ;
		$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
		$image_name = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_temp = $_FILES['image']['tmp_name'];
		$image_type = $_FILES['image']['type'];
		//  echo $image_name;

		$check_image = separator($image_name);
		if ($check_image !== 0) {
			echo "نوع فایل انتخاب شده قابل قبول نیست";
		} elseif ($image_size > 4097152) {
			echo "حجم فایل دریافت شده بیش از حجم مجاز است";
		} else {
			move_uploaded_file($image_temp, '../images/' . $image_name);
			echo 'فایل با موفقیت دریافت شد';
		}
		// echo $logged_in;
		$query = "UPDATE users set profile_pic = '$image_name'  
		WHERE username = '$logged_in'  ";
		$upload_picture = mysqli_query($conn, $query);
		// if (!$upload_picture) echo mysqli_error($conn);
		header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php");
	}
}
