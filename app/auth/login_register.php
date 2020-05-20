 <?php
	session_start();
	require '../../database/database.php';
	require './checkAuth_handler.php';

	?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>ورود و ثبت نام</title>
 	<link rel="stylesheet" href="../../assets/css/login_register.css">
 	<script src="../../assets/js/jquery-3.4.1.min.js"></script>
 </head>

 <body>

 	<div class="loader">
 		<img src="../../assets/img/loading.gif">
 		<p>لطفا صبر کنید..</p>
 	</div>

 	<div class="loginRegister-container">
 		<div class="loginRegister-container-box">
 			<div class="loginRegister-container-box_header">
 				<h3>شبکه اجتماعی</h3>
 			</div>

 			<div class="loginRegister-container-box_loginForm">
 				<form action="login_handler.php" method="POST">
 					<div class="loginRegister-container-box_loginForm_errorBox">
 						<p>اروری وجود ندارد</p>
 					</div>
 					<input type="text" required placeholder="نام کاربری یا ایمیل" name="login_user">

 					<input type="password" required placeholder="رمز عبور" name="login_password">

 					<label for="rememberMe" class="primary__checkbox"> <span>مرا بخاطر بسپار</span>
 						<input type="checkbox" name="remember_me" id="rememberMe" value="0">

 					</label>


 					<input type="submit" value="ورود" name="login">
 				</form>
 				<a class="loginRegister-container-box_loginForm_registerLink">اکانت ندارید؟ثبت نام کنید</a>
 			</div>

 			<div class="loginRegister-container-box_registerForm">
 				<form action="register_handler.php" method="POST">
 					<?php
						if (isset($_SESSION['errors_array'])) {
						?>
 						<div class="loginRegister-container-box_registerForm_errorBox">
 							<?php
								for ($index = 0; $index < count($_SESSION['errors_array']); $index++) {
									echo '<p>' . ($index + 1) . '- ' . $_SESSION['errors_array'][$index] . '</p>';
								}
								?>
 						</div>
 					<?php } ?>

 					<input type="text" placeholder="نام کاربری" name="reg_username" value="<?php
																																									if (isset($_SESSION['reg_username'])) echo $_SESSION['reg_username']; ?>" required>

 					<input type="email" placeholder="ایمیل" name="reg_email" value="<?php
																																						if (isset($_SESSION['reg_email'])) echo $_SESSION['reg_email']; ?>" required>

 					<input type="password" placeholder="رمز عبور" name="reg_password" required>

 					<input type="password" placeholder="تکرار رمز عبور " name="conf_password" required>

 					<label for="male-gender" class="primary__radio">
 						<span>مرد</span>
 						<input type="radio" name="gender" checked value="male">
 					</label>

 					<label for="female-gender" class="primary__radio">
 						<span>زن</span>
 						<input type="radio" name="gender" value="female">
 					</label>

 					<input type="submit" name="register" value="ثبت نام">
 				</form>
 				<a class="loginRegister-container-box_registerForm_loginLink">اکانت دارید؟وارد شوید</a>
 			</div>
 		</div>
 	</div>
 	<script src="../../assets/js/login_register.js"></script>
 </body>

 </html>