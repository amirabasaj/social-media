<?php
    if(isset($_POST['login']) && isset($_POST['login_user']) && isset($_POST['login_password'])){
        $login_user=$_POST['login_user'];
        $login_password=md5($_POST['login_password']);
        $_SESSION['login_user']=$login_user;

        $user=mysqli_query($conn,"SELECT * FROM Users WHERE (username='$login_user' AND password='$login_password') OR (email='$login_user' AND password='$login_user')");
        if(mysqli_num_rows($user)==1){
            $user=mysqli_fetch_array($user);
            $_SESSION['user_username']=$user['username'];
            $_SESSION['user_email']=$user['email'];
            header('Location: ../home.php');
        }
        else{
            array_push($errors_array,'کاربر یافت نشد');
        }
    }
 ?>