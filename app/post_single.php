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
	<title>پست</title>
	<link rel="stylesheet" href="../assets/css/post_single.css">
	<link rel="stylesheet" href="../assets/fonts/font-awesome/all.min.css">
	<link href="../assets/videojs/video-js.css" rel="stylesheet" />
	<script src="../assets/videojs/videojs-ie8.min.js"></script>

</head>

<body>
	<?php

	require './partialViews/header.php';

	?>

	<section class="container">
		<div class="container-post-item">
			<div class="container-post-item_header">
				<!-- <img src="../assets/img/login_register-background.jpg" class="container-post-item_header_img"> -->
				<video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg" data-setup="{}">
					<source src="../assets/video/small.mp4" type="video/mp4" />
				</video>
			</div>
			<div class="container-post-item_body">
				<h3>نویسنده:</h3>
				<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
				<h4 class="mt-3">تگ ها :</h4>
			</div>
			<div class="container-post-item-addcomment">
				<h4 class="mb-3 mt-2">کامنت بذارید:</h4>
				<form>
					<textarea name="message" rows="10">متن کامنت را وارد کنید...</textarea>
					<div class="container-post-item-addcomment_btn">
						<button type="submit">ثبت</button>
					</div>
				</form>
			</div>
			<div class="container-post-item-comments">
				<h4 class="mb-3 mt-2">کامنت ها:</h4>
				<div class="container-post-item-comments_item">
					<div class="container-post-item-comments_item_counter">1</div>
					<h4>علی عباسی میگه:</h4>
					<p>
						لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود

					</p>
				</div>
				<div class="container-post-item-comments_item">
					<div class="container-post-item-comments_item_counter">100</div>
					<h4>علی عباسی میگه:</h4>
					<p>
						لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود

					</p>
				</div>
			</div>
		</div>
	</section>

	<script src="../assets/fonts/font-awesome/all.min.js"></script>
	<script src="../assets/videojs/video.js"></script>
</body>

</html>