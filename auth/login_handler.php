<?php

    session_start();
    require '../database/database.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $jsonResponse;
        $json_str = file_get_contents('php://input');
        $data=json_decode($json_str,true);
        if(!empty($data['login_username']) && !empty($data['login_password'])){

            $login_user=$data['login_username'];
            $login_password=$data['login_password'];
            $login_password=md5($login_password);

            $user=mysqli_query($conn,"SELECT * FROM Users WHERE (username='$login_user' AND password='$login_password') OR (email='$login_user' AND password='$login_password')");

            if(mysqli_num_rows($user)==1){
                $user=mysqli_fetch_array($user);
                $user_username=$user['username'];
                $user_email=$user['email'];
    
                $res=mysqli_query($conn,"UPDATE Users SET online=1 WHERE username='$user_username'");
                
                if($res){
                    $_SESSION['login_username']=$user_username;
                    $_SESSION['login_email']=$user_email;
                    $jsonResponse=array('success'=>'YES');
                }
                else{
                    $jsonResponse= array('success'=>'NO','error'=>'خطا در بر قراری ارتباط با سرور');
    
                }
            }
            else{
                $jsonResponse= array('success'=>'NO','error'=>'کاربر وجود ندارد');
            }
        }
        else{

            $jsonResponse= array('success'=>'NO','error'=>'نام کاربری و رمزعبور نمیتواند خالی باشد');
        }
        echo json_encode($jsonResponse);
    }
 ?>