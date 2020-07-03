<?php
session_start();
ob_start();
global $wanted_author;
global $wanted_title;
global $wanted_tag1;
global $wanted_tag2;
global $wanted_tag3;
global $wanted_tag4;
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
  <link rel="stylesheet" href="../assets/css/home.css">
  <link rel="stylesheet" href="../assets/fonts/font-awesome/all.min.css">
  <link href="../assets/videojs/video-js.css" rel="stylesheet" />
  <script src="../assets/videojs/videojs-ie8.min.js"></script>

</head>

<body>
  <?php
	

	require 'partialViews/header.php';

	?>

  <section class="container">
    <div class="container-main">

      <div class="container-main-posts">

        <?php
				if (isset($_POST['side_submit'])) {

					if (!empty($_POST['science'])) {
						$science_tag = 1;
					} else {
						$science_tag = -1;
					}
					if (!empty($_POST['sport'])) {
						$sport_tag = 1;
					} else {
						$sport_tag = -1;
					}
					if (!empty($_POST['econ'])) {
						$econ_tag = 1;
					} else {
						$econ_tag = -1;
					}
					if (!empty($_POST['political'])) {
						$political_tag = 1;
					} else {
						$political_tag = -1;
					}
					if (!empty($_POST['author'])) {
						$wanted_author = $_POST['author'];
					}
					if (!empty($_POST['title'])) {
						$wanted_title = $_POST['title'];
					} else {
						$wanted_title = 0;
					}
				}
				// echo $wanted_title;
				$i = 0;
				$flag = 0;
				$query = "SELECT * FROM posts WHERE 
				(username = '$wanted_author') OR
				(post_title LIKE '$wanted_title%') OR
				((s_tag = '$science_tag' ) OR
				(sp_tag ='$sport_tag') OR
				(e_tag ='$econ_tag =1' ) OR
				(p_tag ='$political_tag' ) ) ";
				$select_searched_for = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_assoc($select_searched_for)) {
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




        <div class="container-main-posts-item ">
          <div class="container-main-posts-item_header">


            <?php
							switch (separator($post_media)) {
								case 0:
							?>
            <img src="../assets/img/<?php echo $post_media ?>" class="container-main-posts-item_header_img">

            <?php
									break;
								case 1:
								?>
            <video class="video-js" controls preload="auto" poster="../assets/img/login_register-background.jpg"
              data-setup="{}">
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
          <div class="container-main-posts-item_body">
            <a href="user_profile.php?userid=<?php echo $post_username; ?>" <h3>نویسنده: <?php echo $post_username; ?>
              </h3></a>
            <p><?php limited_echo($post_content, 200); ?></p>
            <h4 class="mt-3">تگ ها : <span><?php echo  $post_tags; ?></span> <span><?php echo  $post_tagsp; ?></span>
              <span><?php echo  $post_tage; ?></span> <span><?php echo  $post_tagp; ?></span> </h4>
          </div>
          <div class="container-main-posts-item_footer">
            <a class="container-main-posts-item_footer_icon" data-postid=<?php echo $post_id ?>>

              <i class="fas fa-heart "></i><span class="post-likes"><?php echo $post_likes; ?>
            </a>

            <a href="post_single.php?id=<?php echo $post_id ?>" class="container-main-posts-item_footer_view-btn">مشاهده
              کامل</a>
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
                <input type="checkbox" name="science" value="علمی">
              </label>
            </li>
            <li>
              <label for="rememberMe" class="primary__checkbox">
                <span>ورزشی</span>
                <input type="checkbox" name="sport" value="ورزشی">
              </label>
            </li>
            <li>
              <label for="rememberMe" class="primary__checkbox">
                <span>اقتصادی</span>
                <input type="checkbox" name="econ" value="اقتصادی">
              </label>
            </li>
            <li>
              <label for="rememberMe" class="primary__checkbox">
                <span>سیاسی</span>
                <input type="checkbox" name="political" value="سیاسی">
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

  <script src="../assets/js/jquery-3.4.1.min.js"></script>
  <script src="../assets/fonts/font-awesome/all.min.js"></script>
  <script src="../assets/videojs/video.js"></script>
  <script src="../assets/js/header.js"></script>
  <script src="../assets/js/home.js"></script>
</body>

</html>