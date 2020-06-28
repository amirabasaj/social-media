<?php

session_start();
require '../database/database.php';
require './auth/checkAuth_handler.php';
require 'function.php';

global $logged_in;
global $userid;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/user_profile.css">
	<link rel="stylesheet" href="../assets/fonts/font-awesome/all.min.css">
	<link href="../assets/videojs/video-js.css" rel="stylesheet" />
	<script src="../assets/videojs/videojs-ie8.min.js"></script>
	<script src="../assets/ckeditor/ckeditor.js"></script>
	<script src="../assets/slim-select/slimselect.min.js"></script>
	<link href="../assets/slim-select/slimselect.min.css" rel="stylesheet">
	</link>
	<title>پروفایل</title>
</head>

<body>

	<?php
	if (isset($_GET['userid'])) {

		$userid = $_GET['userid'];
		$_SESSION['userid'] = $userid;
	}
	?>

	<?php require './partialViews/header.php'; ?>
	<section class="profile">
		<?php

		if ($userid == $_SESSION['login_username']) {


		?>
			<ul class="profile-tab-nav">
				<li><a class="active" href="#" data-box="change-info">تغییر اطلاعات</a></li>
				<li><a href="#" data-box="see-statistics">مشاهده پست ها</a></li>
				<li><a href="#" data-box="add-post">افزودن پست جدید</a></li>
			</ul>
			<div class="profile-tab show" id="change-info">

				<?php
				$logged_in =  $_SESSION['login_username'];
				//  echo md5("123");
				if (isset($_POST['pass_submit'])) {
					if (empty($_POST['old-password']) || empty($_POST['new-password'])) {
						die("هیچ کدام از فیلد ها نمیتوانند خالی باشند");
					}
					$entered_old_pass = $_POST['old-password'];
					$entered_old_pass = md5($entered_old_pass);

					// echo $old_pass; 

					$new_pass = $_POST['new-password'];
					$new_pass = str_replace(' ', '', strip_tags($_POST['new-password']));
					if (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $new_pass)) {
						echo ("پسورد باید حداقل ۸ حرف لاتین شامل حداقل یک  حرف. بزرگ و حداقل یک حرف خاص باشد.");
						echo "<br>";
					} else {
						// echo $new_pass;
						$query = "SELECT password from users WHERE username = '$logged_in' ";
						$result = mysqli_query($conn, $query);
						$row = mysqli_fetch_array($result);
						$user_old_pass = $row['password'];
						//  echo $user_old_pass;
						if (($user_old_pass == $entered_old_pass)) {
							//  echo $logged_in;
							$new_pass = md5($new_pass);
							// echo $new_pass;
							$query = "UPDATE users SET password = '$new_pass' WHERE username = '$logged_in' ";
							$update = mysqli_query($conn, $query);
							if (!$update) {
								die("FAILED" . mysqli_error($conn));
							} else {
								echo 'رمز عبور با موفقیت تغییر کرد';
							}
						} else {
							echo " رمز عبور درست نیست ";
						}
					}
				}
				?>

				<form class="change-info-form" action="user_profile.php?userid=<?php echo $_SESSION['login_username'] ?>" method="POST">
					<div>
						<label for="old-password">رمز عبور قبلی</label>
						<input placeholder="رمز عبور قبلی را وارد کنید" type="password" name="old-password" class="primary-input mt-2 mb-2">

						<label for="new-password">رمز عبور جدید</label>
						<input placeholder="رمز عبور جدید را وارد کنید" type="password" name="new-password" class="primary-input mt-2 mb-2">
					</div>
					<div class="change-info-form-submit">
						<button class="change-info-form-submit_btn" name="pass_submit">تغییر رمز</button>
					</div>
				</form>
				<?php
				if (isset($_SESSION['user_profile']['change_pic']))	echo $_SESSION['user_profile']['change_pic'];

				?>
				<form class="change-image-form" action="./includes/photo_change.php" method="POST" enctype="multipart/form-data">
					<div>
						<input type="file" id="image-file" name="image" class="mt-2 mb-2">
						<label for="image-file">انتخاب عکس</label>
					</div>
					<div class="change-image-form-submit">
						<button class="change-image-form-submit_btn" name="upload-image">تغییر عکس</button>
					</div>
				</form>
			</div>



			<div class="profile-tab" id="see-statistics">
				<div class="see-statistics-box">

					<?php

					$query = "SELECT * FROM posts WHERE username = '$logged_in'";
					$select_all_user_post = mysqli_query($conn, $query);
					echo mysqli_error($conn);
					while ($row = mysqli_fetch_assoc($select_all_user_post)) {
						$post_title = $row['post_title'];
						$post_username = $row['username'];
						$post_tags = $row['s_tag'];
						$post_tagsp = $row['sp_tag'];
						$post_tage = $row['e_tag'];
						$post_tagp = $row['p_tag'];
						$post_content = $row['content'];
						$post_likes = $row['likes'];
						$post_media = $row['media'];
						$post_id = $row['post_id'];
						$post_comment_counter = $row['comment_counter'];

						if ($post_tags == 1) {
							$post_tags = '#علمی';
						} else {
							$post_tags = '';
						}
						if ($post_tagsp == 1) {
							$post_tagsp = '#ورزشی';
						} else {
							$post_tagsp = '';
						}
						if ($post_tage == 1) {
							$post_tage = '#اقتصادی';
						} else {
							$post_tage = '';
						}
						if ($post_tagp == 1) {
							$post_tagp = '#سیاسی';
						} else {
							$post_tagp = '';
						}




					?>
						<div class="see-statistics-box-item">
							<div class="see-statistics-box-item_header">
								<?php
								switch (separator($post_media)) {
									case 0:
								?>
										<a href="post_single.php?id=<?php echo $post_id ?>"><img src="./images/<?php echo $post_media ?>" class="container-main-posts-item_header_img"></a>

									<?php
										break;
									case 1:
									?>
										<a href="post_single.php?id=<?php echo $post_id ?>"><video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg" data-setup="{}"></a>
										<source src="../assets/video/<?php echo $post_media ?>" type="video/mp4" />
										</video>

								<?php
										break;
									case -1:
										echo "The Media format not recognized";
										break;
								}
								?>
							</div>
							<div class="see-statistics-box-item_body">
								<p><?php limited_echo($post_content, 200); ?></p>
							</div>
							<div class="see-statistics-box-item_footer">
								<a><i class="fas fa-comment"></i><span class="mr-1"><?php echo $post_comment_counter; ?></span></a>
								<a><i class="fas fa-heart"></i><span class="mr-1"><?php echo $post_likes; ?></span></a>
								<form action="includes/delete_post.php" method="post">
									<input style="display: none" type="text" name="wanted_id" value=<?php echo $post_id ?>>
									<button name="submit" type="submit"><a><i class="fas fa-trash"></i></a></button>
								</form>
							</div>

						</div>
					<?php } ?>

				</div>

			</div>

			</div>

			</div>



			<div class="profile-tab" id="add-post">

				<div class="add-post-box">
					<?php
					if (isset($_SESSION['user_profile']['add post'])) echo $_SESSION['user_profile']['add post'];
					?>
					<form class="add-post-box-form" method="post" action="includes/add_post.php" enctype="multipart/form-data">

						<label for="title">سر تیتر</label>
						<input placeholder="تیتر پست را وارد کنید..." type="text" name="post_title" class="primary-input mt-1 mb-5">

						<div>
							<input type="file" id="post-file" name="image">
							<label for="post-file" class="image-label mt-2 mb-5">انتخاب عکس</label>
						</div>

						<textarea name="post_content" id="myEditor" rows="10" cols="80">متن پست خود را وارد کنید...

                </textarea>
						<script>
							CKEDITOR.replace('myEditor');
						</script>
						<label for="mySelect">انتخاب تگ ها</label>
						<select name="tags[]" style="width: 300px" multiple class="mt-5 mb-5" id="mySelect">
							<option value="elmi">علمی</option>
							<option value="varzeshi">ورزشی</option>
							<option value="eghtesadi">اقتصادی</option>
							<option value="siyasi">سیاسی</option>
						</select>
						<div class="change-image-form-submit">
							<button class="change-image-form-submit_btn" name="add_post">افزودن پست</button>
						</div>
					</form>
				</div>
			</div>
			<?php } else {
			$logged_in = $_SESSION['login_username'];
			$query1 = "SELECT status FROM follow_req WHERE sender = '$logged_in' && getter= '$userid'";
			$result1 = mysqli_query($conn, $query1);
			$row1 = mysqli_fetch_assoc($result1);
			// echo $row1['status'] ;

			if ($row1['status'] == '1') {


			?>


				<form action="includes/unfollow.php" method="POST">
					<div class="change-info-form-submit">
						<button class="request-box_btn_unfollow" name="unfollow">آنفالو</button>
					</div>
				</form>

				<?php } else {
				$logged_in = $_SESSION['login_username'];
				$query2 = "SELECT status FROM follow_req WHERE sender ='$logged_in' && getter = '$userid' ";
				$result2 = mysqli_query($conn, $query2);
				$row2 = mysqli_fetch_assoc($result2);
				if (!$row2) {

				?>
					<form action="includes/follow_req.php" class="request-box" method="POST">
						<button class="request-box_btn_follow" name="follow_req">دنبال کردن</button>
					</form>

				<?php } else {

				?>

					<form action="includes/unfollow.php" class="request-box" method="POST">
						<button class="request-box_btn_pending" name="in_progress">درخواست در حال بررسی
						</button>
					</form>
			<?php }
			}


			?>

			<div class="another-user">
				<div class="another-user-image">
					<?php

					$query = "SELECT profile_pic FROM users WHERE username = '$userid'";
					$other_user_pic = mysqli_query($conn, $query);
					$other_user_pic = mysqli_fetch_row($other_user_pic);

					?>
					<img src="images/<?php echo  $other_user_pic[0];  ?>" class="offline" alt="user image">
				</div>

				<div class="another-user-info">
					<h3>نام کاربری:<span><?php echo $userid ?></span></h3>
				</div>
				<?php
				$query = "SELECT private FROM users WHERE username = '$userid'";
				$privacy = mysqli_query($conn, $query);
				$privacy = mysqli_fetch_row($privacy);
				$query = "SELECT status FROM follow_req WHERE sender = '$logged_in' && getter = '$userid'";
				$following = mysqli_query($conn, $query);
				$following = mysqli_fetch_row($following);
				if ($privacy[0] == 1 && $following[0] == 0) {
				?>
					<div class="another-user-posts">
						<img src="../assets/img/lock-icon.png" alt="">

					<?php } else { ?>

						<div class="another-user-posts-box">

							<?php

							$query = "SELECT * FROM posts WHERE username = '$userid'";
							$select_all_user_post = mysqli_query($conn, $query);
							echo mysqli_error($conn);
							while ($row = mysqli_fetch_assoc($select_all_user_post)) {
								$post_title = $row['post_title'];
								$post_username = $row['username'];
								$post_tags = $row['s_tag'];
								$post_tagsp = $row['sp_tag'];
								$post_tage = $row['e_tag'];
								$post_tagp = $row['p_tag'];
								$post_content = $row['content'];
								$post_likes = $row['likes'];
								$post_media = $row['media'];
								$post_id = $row['post_id'];
								$post_comment_counter = $row['comment_counter'];

								if ($post_tags == 1) {
									$post_tags = '#علمی';
								} else {
									$post_tags = '';
								}
								if ($post_tagsp == 1) {
									$post_tagsp = '#ورزشی';
								} else {
									$post_tagsp = '';
								}
								if ($post_tage == 1) {
									$post_tage = '#اقتصادی';
								} else {
									$post_tage = '';
								}
								if ($post_tagp == 1) {
									$post_tagp = '#سیاسی';
								} else {
									$post_tagp = '';
								}




							?>
								<div class="another-user-posts-box-item">
									<div class="another-user-posts-box-item_header">
										<?php
										switch (separator($post_media)) {
											case 0:
										?>
												<a href="post_single.php?id=<?php echo $post_id ?>"><img src="./images/<?php echo $post_media ?>" class="another-user-posts-box-item_header_img"></a>

											<?php
												break;
											case 1:
											?>
												<a href="post_single.php?id=<?php echo $post_id ?>"><video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg" data-setup="{}"></a>
												<source src="../assets/video/<?php echo $post_media ?>" type="video/mp4" />
												</video>

										<?php
												break;
											case -1:
												echo "The Media format not recognized";
												break;
										}
										?>
									</div>
									<div class="another-user-posts-box-item_body">
										<p><?php limited_echo($post_content, 200); ?></p>
									</div>
									<div class="another-user-posts-box-item_footer">
										<a><i class="fas fa-comment"></i><span class="mr-1"><?php echo $post_comment_counter; ?></span></a>
										<a><i class="fas fa-heart"></i><span class="mr-1"><?php echo $post_likes; ?></span></a>
									</div>

								</div>
							<?php } ?>

						</div>

					</div>
			</div>
			</div>


	<?php }
			} ?>


	</section>
	<script src="../assets/js/jquery-3.4.1.min.js"></script>
	<script src="../assets/fonts/font-awesome/all.min.js"></script>
	<script src="../assets/videojs/video.js"></script>
	<script src="../assets/js/user_profile.js"></script>
	<script src="../assets/js/header.js"></script>
</body>

</html>