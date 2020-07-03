<?php

if ($_SERVER['REQUEST_URI'] == '/app/partialViews/header.php') {
	header("Location: ../home.php");
}

$userPic = '';
$res = mysqli_query($conn, "SELECT profile_pic FROM users WHERE username='$_SESSION[login_username]'");
if (mysqli_num_rows($res) == 1) {
	$res = mysqli_fetch_array($res);
	$userPic = $res['profile_pic'];
}
?>
<header class="header">

  <div class="header-imgbox">
    <img src="../app/images/<?php echo $userPic ?>">
    <span><?php echo $_SESSION['login_username'] ?></span>
  </div>
  <form class="header-searchbox">
    <div class="header-searchbox-content">

      <input name="search" class='header-searchbox-input' type="text" placeholder="جست و جو..">
      <button class="header-searchbox-content_icon" name="submit" type="submit">
        <i class="fa fa-search"></i>
      </button>

    </div>
    <div class="header-searchbox-result">
      <ul>
      </ul>
    </div>
  </form>
  <div class="header-operation">

    <a href="home.php" class="header-operation_home">
      <i class="fa fa-home fa-3x"></i>
    </a>
    <a href="user_profile.php?userid=<?php echo $_SESSION['login_username'] ?>" class="header-operation_userProfile">
      <i class="fa fa-user-alt fa-3x"></i>
    </a>
    <?php
		$logged_in = $_SESSION['login_username'];
		$userid = $_SESSION['userid'];
		$query = "SELECT * FROM follow_req WHERE getter = '$logged_in' && status = '0'";
		$follow_req = mysqli_query($conn, $query); ?>
    <a href="#" class="header-operation_bell">
      <?php if(mysqli_num_rows($follow_req)>=1){?>
      <span class="header-operation_bell_notif-count"><?php  echo mysqli_num_rows($follow_req) ?></span>
      <?php } ?>
      <i class="fa fa-bell fa-3x"></i>
      <div class="header-operation-request-box">
        <ul>

          <?php
					$logged_in = $_SESSION['login_username'];
					$userid = $_SESSION['userid'];
					$query = "SELECT * FROM follow_req WHERE getter = '$logged_in'";
					$follow_req = mysqli_query($conn, $query);
					for ($i = 0; $row = mysqli_fetch_assoc($follow_req); $i++) {

						$sender = $row['sender'];
						$status = $row['status'];
						if ($status == 0) {
							$query = "SELECT profile_pic FROM users WHERE username = '$sender'";
							$pic = mysqli_query($conn, $query);
							$pic = mysqli_fetch_row($pic);

					?>
          <li>
            <img src="./images/<?php echo $pic[0]; ?>" alt="">
            <span><?php echo $sender ?></span>
            <div>
              <form action="includes/accept_decline.php" method="POST">
                <input type="text" name="sender" value="<?php echo $sender ?>" style="display: none">
                <button type="submit" name="accept"><i class="fas fa-check-circle"></i></button>
              </form>
              <form action="includes/accept_decline.php" method="POST">
                <input type="text" name="sender" value="<?php echo $sender ?>" style="display: none">
                <button type="submit" name="decline"><i class="fas fa-times-circle"></i></button>
              </form>
            </div>
          </li>
          <?php }
					} ?>
        </ul>
      </div>
    </a>
    <a href="home.php" class="header-operation_users">
      <i class="fa fa-users fa-3x"></i>
    </a>
    <a href="./logout.php" class="header-operation_signout">
      <i class="fas fa-sign-out-alt fa-3x"></i>
    </a>
  </div>
</header>