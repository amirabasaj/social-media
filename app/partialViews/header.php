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
	</div>
	<form class="header-searchbox">
		<div class="header-searchbox-content">

			<input name="search" type="text" placeholder="جست و جو..">
			<button class="header-searchbox-content_icon" name="submit" type="submit">
				<i class="fa fa-search"></i>
			</button>

		</div>
	</form>
	<div class="header-operation">

		<a href="home.php" class="header-operation_home">
			<i class="fa fa-home fa-3x"></i>
		</a>
		<a href="home.php" class="header-operation_envelope">
			<i class="fa fa-envelope fa-3x"></i>
		</a>
		<a href="#" class="header-operation_bell">
			<span class="header-operation_bell_notif-count">100</span>
			<i class="fa fa-bell fa-3x"></i>
			<div class="header-operation-request-box">
			<ul>
			<li>
				<img src="./images/user-male.jpg" alt="">
				<span>username</span>
				<div>
				<form action="">
				<button type="submit"><i class="fas fa-check-circle"></i></button>
				</form>
				<form action="">
				<button type="submit"><i class="fas fa-times-circle"></i></button>
				</form>
				</div>
			</li>
			<li>
				<img src="./images/user-male.jpg" alt="">
				<span>username</span>
				<div>
				<form action="">
				<button type="submit"><i class="fas fa-check-circle"></i></button>
				</form>
				<form action="">
				<button type="submit"><i class="fas fa-times-circle"></i></button>
				</form>
				</div>
			</li>
			</ul>
			</div>
		</a>
		<a href="home.php" class="header-operation_users">
			<i class="fa fa-users fa-3x"></i>
		</a>
		<a href="user_profile.php?userid=<?php echo $_SESSION['login_username'] ?>" class="header-operation_cog">
			<i class="fa fa-cog fa-3x"></i>
		</a>
	</div>
</header>