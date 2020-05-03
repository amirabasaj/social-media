<?php
session_start();
ob_start();
global $wanted_author;
global $wanted_title;
global $wanted_tags;
global $flag;

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
			if (isset($_POST['side_submit'])) {

				if (!empty($_POST['author'])) {
					global $wanted_author;

					$wanted_author = $_POST['author'];
					//  echo $wanted_author .' ';
				}

				if (!empty($_POST['title'])) {

					global $wanted_title;

					$wanted_title = $_POST['title'];
					echo $wanted_title .' ';
				}
				if (!empty($_POST['check_list'])) {
					global $wanted_tags;
					$wanted_tags = join(",", $_POST['check_list']);
					echo $wanted_tags;
				}
			}

			?>







				<?php
				if (empty($wanted_author)){
					echo "EMPTY";
				}else{
					echo $wanted_author;
				}
				$i = 0;
				$flag = 0;
				$query = "SELECT * FROM posts WHERE 
				author = '$wanted_author' OR
				(post_title = '$wanted_title') OR
				 ((tag1 LIKE '%$wanted_tags%') OR
				 (tag2 LIKE '%$wanted_tags%') OR
				 (tag3 LIKE '%$wanted_tags%'))
				 ";
				$select_searched_for = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_assoc($select_searched_for)) {
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
							<a href="home.php?liked=<?php echo $post_id; ?>" class="container-main-posts-item_footer_icon">

								<?php
								like();
								?>



								<i class="fas fa-heart "></i><span><?php echo $post_likes; ?></span>
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
								<input type="checkbox" name="check_list[]" value="علمی">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>ورزشی</span>
								<input type="checkbox" name="check_list[]" value="ورزشی">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>اقتصادی</span>
								<input type="checkbox" name="check_list[]" value="اقتصادی">
							</label>
						</li>
						<li>
							<label for="rememberMe" class="primary__checkbox">
								<span>سیاسی</span>
								<input type="checkbox" name="check_list[]" value="سیاسی">
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
						<input type="text" name="title" class="primary-input">
					</div>

					<button type="submit" class="container-main-searchbox-form-submit" name="side_submit">جستجو</button>
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