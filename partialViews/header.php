
<?php

    $userPic='';
    $res=mysqli_query($conn,"SELECT profile_pic FROM users WHERE username='$_SESSION[login_username]'");
    if(mysqli_num_rows($res)==1){
        $res=mysqli_fetch_array($res);
        $userPic=$res['profile_pic'];
    }
?>
<header class="header">

    <div class="header-imgbox">
        <img src="<?php echo $userPic ?>">
    </div>
    <form class="header-searchbox">
        <input type="text">
        <button>
            
        </button>
    </form>
    <div class="header-operation">

    </div>
</header>