<?php
session_start();
$http = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
if (isset($_POST['register']) && isset($_POST['reg_username']) && isset($_POST['reg_email']) && isset($_POST['reg_password']) && isset($_POST['conf_password'])) {

	$errors_array = array();
	require '../../database/database.php';


	$reg_username = str_replace(' ', '', strip_tags($_POST['reg_username']));
	$reg_email = str_replace(' ', '', strip_tags($_POST['reg_email']));
	$reg_password = str_replace(' ', '', strip_tags($_POST['reg_password']));
	$confPassword = str_replace(' ', '', strip_tags($_POST['conf_password']));
	$gender = $_POST['gender'];
	$_SESSION['reg_username'] = $reg_username;
	$_SESSION['reg_email'] = $reg_email;
	if ($reg_password !== $confPassword) {
		array_push($errors_array, 'پسورد و تایید  پسورد مشابه هم نمی باشد.');
	}
	if (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $reg_password)) {
		array_push($errors_array, '  پسورد باید حداقل ۸ حرف لاتین شامل حداقل یک  حرف. بزرگ و حداقل یک حرف خاص باشد. ');
	}
	if (filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
		$checkEmailResult = mysqli_query($conn, "SELECT email FROM users WHERE email='$reg_email'");

		if (mysqli_num_rows($checkEmailResult) != 0) {
			array_push($errors_array, 'ایمیل قبلا ثبت شده.');
		}
	} else {
		array_push($errors_array, 'فرمت ایمیل صحیح نمی باشد.');
	}

	$checkUsernameResult = mysqli_query($conn, "SELECT username FROM users WHERE username='$reg_username'");
	if (mysqli_num_rows($checkUsernameResult) > 0) {
		array_push($errors_array, 'نام کاربری وجود دارد.');
	}


	if (count($errors_array) == 0) {
		$reg_password = md5($reg_password);
		$userPic;
		$date = date('Y-m-d');
		if ($gender == 'male') {
			$gender = 0;
			$userPic = '../images/user-male.jpg';
		} else {
			$userPic = '../images/user-female.jpg';
			$gender = 1;
		}

		$res = mysqli_query($conn, "INSERT INTO users (username, email, password,profile_pic, signup_date, gender) VALUES('$reg_username','$reg_email','$reg_password','$userPic','$date','$gender')");
		if ($res != TRUE) array_push($errors_array, 'مشکل در ثبت کاربر جدید.');
		else {
			$_SESSION['reg_username'] = '';
			$_SESSION['reg_email'] = '';
			$_SESSION['login_username'] = $reg_username;
			header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/home.php");
		}
	} else {

		$_SESSION['errors_array'] = $errors_array;
		header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/auth/login_register.php");
	}
} else {
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/auth/login_register.php");
}
