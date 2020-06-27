<?php
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['add_post'])) {
		$logged_in =  $_SESSION['login_username'];
		$_SESSION['user_profile']['add post'] = "";

		$new_post_title = $_POST['post_title'];
		$new_image_name = $_FILES["image"]['name'];
		$new_image_size = $_FILES['image']['size'];
		$new_image_temp = $_FILES['image']['tmp_name'];
		$new_image_type = $_FILES['image']['type'];
		$new_post_content = $_POST['post_content'];
		$new_post_tags = $_POST['tags'];
		if (!empty($new_post_tags)) {
			$elmi = 0;
			$varzeshi = 0;
			$eghtesadi = 0;
			$siyasi = 0;

			if (in_array("elmi", $new_post_tags)) {
				$elmi = 1;
			}
			if (in_array("varzeshi", $new_post_tags)) {
				$varzeshi = 1;
			}
			if (in_array("eghtesadi", $new_post_tags)) {
				$eghtesadi = 1;
			}
			if (in_array("siyasi", $new_post_tags)) {
				$siyasi = 1;
			}
			// echo "elmi" . $elmi;
			// echo "varzeshi" . $varzeshi;
			// echo "eghtesadi" . $eghtesadi;
			// echo "siyasi" . $siyasi;
			// echo $logged_in;
		}
		if (empty($new_post_title)) {
		
			$_SESSION['user_profile']['add post'] = "تیتر پست نمیتواند خالی باشد";
		} elseif ($new_image_size !== 0) {
			$check_image = separator($new_image_name);
			if ($check_image !== 0) {

				$_SESSION['user_profile']['add post'] = "نوع فایل انتخاب شده قابل قبول نیست";
			} elseif ($new_image_size > 4097152) {
				$_SESSION['user_profile']['add post'] = "حجم فایل دریافت شده بیش از حجم مجاز است";
			} else {
				move_uploaded_file($new_image_temp, '../images/' . $new_image_name);
				$query = "INSERT INTO posts(post_title , username , s_tag , sp_tag , e_tag , p_tag ,content , media) VALUES ('$new_post_title' ,'$logged_in' ,'$elmi', '$varzeshi', '$eghtesadi' , '$siyasi', '$new_post_content' , '$new_image_name')";
				$insert_post = mysqli_query($conn, $query);
				if (!$insert_post) echo ("FAILED" . mysqli_error($conn));
			}
		}

		
	}
	$userid = $_SESSION['login_username'] ;
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/user_profile.php?userid=$userid");
}
