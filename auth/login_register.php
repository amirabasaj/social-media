 <?php
     ob_start();
     require '../database/database.php';
     session_start();
     $errors_array=array();
     if($conn)
     {
        require './register_handler.php';
       
     }
     else{
        array_push($errors_array,'مشکل در برقراری ارتباط با سرور');
    }

            
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

<div class="loader">
    <img src="../assets/img/loading.gif">
    <p>لطفا صبر کنید..</p>
</div>    

<div class="loginRegister-container">
    <div class="loginRegister-container-box">
        <div class="loginRegister-container-box_header">
            <h3>شبکه اجتماعی</h3>
        </div>

        <div class="loginRegister-container-box_loginForm">
            <form action="login_handler.php" method="POST">
                <?php if(in_array('کاربر یافت نشد',$errors_array))  echo 'کاربر یافت نشد';
                    if(in_array('خطا در بر قراری ارتباط با سرور',$errors_array)) echo'خطا در بر قراری ارتباط با سرور';
                ?>
                <input type="text" required placeholder="نام کاربری یا ایمیل" name="login_user">

                <input type="password" required placeholder="رمز عبور"name="login_password">

                <label for="rememberMe" class="loginRegister-container-box_loginForm_remember">            <span>مرا بخاطر بسپار</span>
                <input type="checkbox" name="remember_me" id="rememberMe">

                </label>


                <input type="submit" value="ورود" name="login">
            </form> 
            <a class="loginRegister-container-box_loginForm_registerLink">اکانت ندارید؟ثبت نام کنید</a>
        </div>   

        <div class="loginRegister-container-box_registerForm">
            <form action="login_register.php" method="POST">
                <?php
                    if(count($errors_array)>0){
                        for($index=0;$index<count($errors_array);$index++){
                            echo $errors_array[$index].'<br>';
                        }
                    }
                 ?>
                <input type="text" placeholder="نام کاربری" name="reg_username" value="<?php
                if($_SESSION['reg_username']) echo $_SESSION['reg_username']; ?>"required>
    
                <input type="email" placeholder="ایمیل" name="reg_email" value="<?php
                if($_SESSION['reg_email']) echo $_SESSION['reg_email']; ?>" required>
    
                <input type="password" placeholder="رمز عبور" name="reg_password"required>
    
                <input type="password" placeholder="تکرار رمز عبور "name="conf_password"      required>
    
                <label for="male-gender" class="loginRegister-container-box_registerForm_gender">
                    <span>مرد</span>
                    <input type="radio" name="gender" checked value="male">
                </label>
    
                <label for="female-gender" class="loginRegister-container-box_registerForm_gender">
                    <span>زن</span>
                    <input type="radio" name="gender" value="female">
                </label>
    
                <input type="submit" name="register" value="ثبت نام">
            </form>
            <a class="loginRegister-container-box_registerForm_loginLink">اکانت دارید؟وارد شوید</a>
        </div>
    </div>
</div>
<script src="../assets/js/login_register.js"></script>
</body>
</html>

