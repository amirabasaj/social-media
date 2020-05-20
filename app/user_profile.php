<?php

session_start();
require '../database/database.php';
require './auth/checkAuth_handler.php';
include 'function.php';

global $logged_in;
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

	<?php require './partialViews/header.php'; ?>
	<section class="profile">
		<ul class="profile-tab-nav">
			<li><a class="active" href="#" data-box="change-info">تغیر اطلاعات</a></li>
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

			<form class="change-info-form" action="user_profile.php" method="POST">
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

			<form class="change-image-form" action="photo_change.php" method="POST" enctype="multipart/form-data">
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
									<img src="../assets/img/<?php echo $post_media ?>" class="container-main-posts-item_header_img">

								<?php
									break;
								case 1:
								?>
									<video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg" data-setup="{}">
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
							<a href="user_profile.php?delete=<?php echo $post_id ?>"><i class="fas fa-trash"></i></a>
						</div>

					</div>
				<?php } ?>

			</div>

		</div>

		</div>

		</div>
		<?php
		// if (isset($_GET['delete'])) {
		// 	$delete_id = $_GET['delete'];


		// 	$query = "DELETE FROM posts WHERE post_id ='$delete_id' AND username = '$logged_in' ";
		// 	$delete_post = mysqli_query($conn, $query);
		// 	echo mysqli_error($conn);
		// 	$_GET['delete'] = '';
		// }

		?>


		<div class="profile-tab" id="add-post">

			<div class="add-post-box">
				<?php

				// if (isset($_POST['add_post'])) {

				// 	$new_post_title = $_POST['post_title'];
				// 	$new_image_name = $_FILES["image"]['name'];
				// 	$new_image_size = $_FILES['image']['size'];
				// 	$new_image_temp = $_FILES['image']['tmp_name'];
				// 	$new_image_type = $_FILES['image']['type'];
				// 	$new_post_content = $_POST['post_content'];
				// 	$new_post_tags = $_POST['tags'];
				// 	if (!empty($new_post_tags)) {
				// 		$elmi = 0;
				// 		$varzeshi = 0;
				// 		$eghtesadi = 0;
				// 		$siyasi = 0;

				// 		if (in_array("elmi", $new_post_tags)) {
				// 			$elmi = 1;
				// 		}
				// 		if (in_array("varzeshi", $new_post_tags)) {
				// 			$varzeshi = 1;
				// 		}
				// 		if (in_array("eghtesadi", $new_post_tags)) {
				// 			$eghtesadi = 1;
				// 		}
				// 		if (in_array("siyasi", $new_post_tags)) {
				// 			$siyasi = 1;
				// 		}
				// 		// echo "elmi" . $elmi;
				// 		// echo "varzeshi" . $varzeshi;
				// 		// echo "eghtesadi" . $eghtesadi;
				// 		// echo "siyasi" . $siyasi;
				// 		// echo $logged_in;
				// 	}
				// 	if (empty($new_post_title)) {
				// 		echo "تیتر پست نمیتواند خالی باشد";
				// 	} elseif ($new_image_size !== 0) {
				// 		$check_image = separator($new_image_name);
				// 		if ($check_image !== 0) {
				// 			echo "نوع فایل انتخاب شده قابل قبول نیست";
				// 		} elseif ($new_image_size > 4097152) {
				// 			echo "حجم فایل دریافت شده بیش از حجم مجاز است";
				// 		} else {
				// 			move_uploaded_file($new_image_temp, 'new_post_image/' . $new_image_name);
				// 		}
				// 	}

				// 	$query = "INSERT INTO posts(post_title , username , s_tag , sp_tag , e_tag , p_tag ,content , media) VALUES ('$new_post_title' ,'$logged_in' ,'$elmi', '$varzeshi', '$eghtesadi' , '$siyasi', '$new_post_content' , '$new_image_name')";
				// 	$insert_post = mysqli_query($conn, $query);
				// 	if (!$insert_post) echo ("FAILED" . mysqli_error($conn));
				// }


				?>
				<form class="add-post-box-form" method="post" action="user_profile.php" enctype="multipart/form-data">

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
	</section>
	<script src="../assets/fonts/font-awesome/all.min.js"></script>
	<script src="../assets/videojs/video.js"></script>
	<script src="../assets/js/user_profile.js"></script>
</body>

</html>