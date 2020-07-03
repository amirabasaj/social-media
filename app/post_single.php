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

  <?php
	global $logged_in;
	$logged_in = $_SESSION['login_username'];
	if (isset($_GET['id'])) {
		$clicked_post = $_GET['id'];
	}

	$query = "SELECT * FROM posts WHERE post_id = '$clicked_post'";
	
	$single_post = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($single_post);

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
	
	$login_username=$_SESSION['login_username'];
	$query = "SELECT status FROM follow_req WHERE sender = '$login_username' and getter='$post_username'";
	$res = mysqli_query($conn, $query);
	$res=mysqli_fetch_row($res);
	if(!$res[0] && $login_username!=$post_username){
		
		header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/home.php");
	}
	?>

  <section class="container">
    <div class="container-post-item">
      <div class="container-post-item_header">

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
      <div class="container-post-item_body">
        <h3>تیتر: <?php echo $post_title ?></h3>
        <p><?php echo $post_content ?></p>
        <h4 class="mt-3">تگ ها : <span><?php echo  $post_tags; ?></span> <span><?php echo  $post_tagsp; ?></span>
          <span><?php echo  $post_tage; ?></span> <span><?php echo  $post_tagp; ?></span></h4>
      </div>
      <div class="container-post-item-addcomment">
        <h4 class="mb-3 mt-2">کامنت بذارید:</h4>
        <form action="includes/add_comment.php" method="POST">
          <input style="display: none" name="clicked_post" type="text" value=<?php echo $clicked_post ?>>
          <textarea name="comment" rows="10">متن کامنت را وارد کنید...</textarea>
          <div class="container-post-item-addcomment_btn">
            <button type="submit" name="add_comment">ثبت</button>
          </div>
        </form>
      </div>


      <div class="container-post-item-comments">
        <h4 class="mb-3 mt-2">کامنت ها:</h4>
        <?php

				$query = "SELECT * FROM comments WHERE post_id = '$clicked_post' ";
				$show_comments = mysqli_query($conn, $query);
				if (!$show_comments) die("FAILED" . mysqli_error($conn));
				
				for ($i = 1; $row = mysqli_fetch_assoc($show_comments); $i++) {
					$username = $row['username'];
					$comment = $row['comment'];

				?>
        <div class="container-post-item-comments_item">

          <div class="container-post-item-comments_item_counter"><?php echo $i ?></div>
          <h4><?php echo $username ?> میگه:</h4>
          <p>
            <?php echo $comment ?>
          </p>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <script src="../assets/js/jquery-3.4.1.min.js"></script>
  <script src="../assets/fonts/font-awesome/all.min.js"></script>
  <script src="../assets/videojs/video.js"></script>
  <script src="../assets/js/header.js"></script>
</body>

</html>