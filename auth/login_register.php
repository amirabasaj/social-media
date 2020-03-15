 <?php
 
     include '../database/database.php';
     $conn=dbConnection();
     session_start();
     $errors_array=array();
     if($conn)
     {

         if(isset($_POST['reg_username'])&&isset($_POST['reg_email'])&&isset($_POST['reg_password'])&&isset($_POST['conf_password'])){
             
            
            $reg_username=str_replace(' ','',strip_tags($_POST['reg_username']));
            $reg_email=str_replace(' ','',strip_tags($_POST['reg_email']));
            $reg_password=str_replace(' ','',strip_tags($_POST['reg_password']));
            $confPassword=str_replace(' ','',strip_tags($_POST['conf_password']));
            $gender=$_POST['gender'];
            $_SESSION['reg_username']=$reg_username;
            $_SESSION['reg_email']=$reg_email;
            if($reg_password!==$confPassword){
                array_push($errors_array,'Password And Confirm Password Not Match!');
            }
            if(!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/',$reg_password)){
                array_push($errors_array,'  پسورد باید حداقل ۸ حرف لاتین شامل حداقل یک  حرف بزرگ و حداقل یک حرف خاص باشد ');
            }
            if(filter_var($reg_email,FILTER_VALIDATE_EMAIL)){
                $checkEmailResult=mysqli_query($conn,"SELECT email FROM Users WHERE emial='$reg_email'");
                
                if(mysqli_num_rows($checkEmailResult)>0){
                    array_push($errors_array,'ایمیل قبلا ثبت شده ');
                }
            }
            else{
               array_push($errors_array,'فرمت ایمیل صحیح نمی باشد');
            }

            $checkUsernameResult=mysqli_query($conn,"SELECT username FROM Users WHERE username='$reg_username'");
            if(mysqli_num_rows($checkUsernameResult)>0){
                array_push($errors_array,'نام کاربری وجود دارد');
            }
            
            if(count($errors_array)==0){
                $reg_password=md5($reg_password);
                $userPic;
                $date=date('Y-m-d');
                if($gender=='male'){
                    $gender=0;
                    $userPic=$_SERVER['HTTP_HOST'].'/assets/img/user-male.jpg';
                }
                else{
                    $userPic=$_SERVER['HTTP_HOST'].'/assets/img/user-female.jpg';
                    $gender=1;
                }

                $res=mysqli_query($conn,"INSERT INTO Users (username, email, password,profile_pic, signup_date, gender) VALUES('$reg_username','$reg_email','$reg_password','$userPic','$date','$gender')");
                if($res!=TRUE) array_push( $errors_array,'مشکل در ثبت کاربر جدید');
                else{
                    $_SESSION['reg_username']='';
                    $_SESSION['reg_email']='';
                }
            }
        }
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
    
<form action="./login_register.php" method="POST">
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
        <input type="password" placeholder="confirm password" name="conf_password" required>
        <br>
        <label>male</label>
        <input type="radio" name="gender" checked value="male">
        <label>female</label>
        <input type="radio" name="gender" value="female">
        <br>
        <input type="submit" value="send">
    </form>
</body>
</html>