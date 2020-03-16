 <?php
     ob_start();
     require '../database/database.php';
     session_start();
     $errors_array=array();
     if($conn)
     {
        require './register_handler.php';
        require './login_handler.php';
       
     }
     else{
        array_push($errors_array,'مشکل در برقراری ارتباط با سرور');
    }

    ob_end_clean();
            
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود و ثبت نام</title>
    <link rel="stylesheet" href="../assets/css/login_register.css">
</head>
<body>
    

<div class="loginRegister-container">
    <div class="loginRegister-container-main">
            <form action="login_register.php" method="POST">
                <?php if(in_array('کاربر یافت نشد',$errors_array))  echo 'کاربر یافت نشد';
                      if(in_array('خطا در بر قراری ارتباط با سرور',$errors_array)) echo 'خطا در بر قراری ارتباط با سرور';
                ?>

                <input type="text" required placeholder="email or username" value="<?php

                   if(isset($_SESSION['login_user'])) echo $_SESSION['user_username'];
                 ?>" name="login_user">

                <br>
                <input type="password" required placeholder="password" name="login_password">
                <br>
                <label>remember me</label>
                <input type="checkbox" name="remember_me">
                <br>
                <input type="submit" value="login" name="login">
            </form> 

            <form action="login_register.php" method="POST">
                <?php
                    if(count($errors_array)>0){
                        for($index=0;$index<count($errors_array);$index++){
                            echo $errors_array[$index].'<br>';
                        }
                    }
                 ?>
                <input type="text" placeholder="username" name="reg_username" value="<?php
                if($_SESSION['reg_username']) echo $_SESSION['reg_username']; ?>" required>
                <br>
                <input type="email" placeholder="email" name="reg_email" value="<?php
                if($_SESSION['reg_email']) echo $_SESSION['reg_email']; ?>" required>
                <br>
                <input type="password" placeholder="password" name="reg_password" required>
                <br>
                <input type="password" placeholder="confirm password" name="conf_password"      required>
                <br>
                <label>male</label>
                <input type="radio" name="gender" checked value="male">
                <label>female</label>
                <input type="radio" name="gender" value="female">
                <br>
                <input type="submit" name="register" value="register">
            </form>
        </div>
    </div>
</body>
</html>

