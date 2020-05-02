<?php
session_start();
ob_start();

require '../database/database.php';
require './auth/checkAuth_handler.php';
?>
<?php include "function.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>خانه</title>
	<link rel="stylesheet" href="../../assets/css/home.css">
	<link rel="stylesheet" href="../../assets/fonts/font-awesome/all.min.css">
	<link href="../../assets/videojs/video-js.css" rel="stylesheet" />
	<script src="../../assets/videojs/videojs-ie8.min.js"></script>

</head>

<body>
	<?php

	require './partialViews/header.php';

	?>

	<section class="container">
		<div class="container-main">

			<div class="container-main-posts">

				<?php

				global $flag;
				$flag = 0;
				$query = "SELECT * FROM posts ";
				$select_all_posts = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_assoc($select_all_posts)) {
					$post_title = $row['post_title'];
					$post_author = $row['author'];
					$post_tag1 = $row['tag1'];
					$post_tag2 = $row['tag2'];
					$post_tag3 = $row['tag3'];
					$post_content = $row['content'];
					$post_likes = $row['likes'];
					$post_media = $row['media'];
					$post_id = $row['post_id'];
				?>




					<div class="container-main-posts-item ">
						<div class="container-main-posts-item_header">


							<?php
							switch (separator($post_media)) {
								case 0:
							?>
									<img src="../assets/img/login_register-background.jpg" class="container-main-posts-item_header_img">

								<?php
									break;
								case 1:
								?>
									<video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg" data-setup="{}">
										<source src="../assets/video/small.mp4" type="video/mp4" />
									</video>

							<?php
									break;
								case -1:
									echo "The Media format not recognized";
									break;
							}
							?>


						</div>
						<div class="container-main-posts-item_body">
							<h3>نویسنده: <?php echo $post_author; ?></h3>
							<p><?php limited_echo($post_content, 200); ?></p>
							<h4 class="mt-3">تگ ها : <span><?php echo "#" . $post_tag1; ?>،</span> <span><?php echo "#" . $post_tag2; ?>،</span> <span><?php echo "#" . $post_tag3; ?></span> </h4>
						</div>
						<div class="container-main-posts-item_footer">
							<a  class="container-main-posts-item_footer_icon" data-postid=<?php echo $post_id ?>>

								<i class="fas fa-heart "></i><span class='post-likes'><?php echo $post_likes; ?></span>
							</a>
							<a href="#" class="container-main-posts-item_footer_view-btn">مشاهده کامل</a>
						</div>
					</div>



				<?php } ?>
			</div>



			<div class="container-main-searchbox">

				<form class="container-main-searchbox-form" action="search.php" method="POST">
					<h3 class="text-align-center mt-3">جست و جو</h3>
					<ul class="container-main-searchbox-form-tags">
						<h4 class=" mt-3">تگ ها:</h4>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>علمی</span>
								<input type="checkbox" name="remember_me" value="0">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>ورزشی</span>
								<input type="checkbox" name="remember_me" value="0">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>اقتصادی</span>
								<input type="checkbox" name="remember_me" value="0">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>سیاسی</span>
								<input type="checkbox" name="remember_me" value="0">
							</label>
						</li>
					</ul>
					<div class="container-main-searchbox-form-author  mb-3 mt-3">
						<label for="author-search-input">
							<h4>نام نویسنده:</h4>
						</label>
						<input type="text" name="author" class="primary-input">
					</div>
					<div class="container-main-searchbox-form-username mb-3">
						<label for="username-search-input">
							<h4>تیتر:</h4>
						</label>
						<input type="text" name="username-search-input" class="primary-input">
					</div>

					<button type="submit" class="container-main-searchbox-form-submit" name="submit">جستجو</button>
				</form>
				<div class="container-main-searchbox-advertising">
					تبلیغات
				</div>
			</div>


		</div>
	</section>

	<script src="../../assets/fonts/font-awesome/all.min.js"></script>
	<script src="../../assets/videojs/video.js"></script>
	<script src="../../assets/js/home.js"></script>
</body>

</html>