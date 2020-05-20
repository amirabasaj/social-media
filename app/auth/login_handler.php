<?php

    session_start();
    $http=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");

    require '../../database/database.php';

    function encryptCookie($value){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'WS-SERVICE-KEY';
        $secret_iv = 'WS-SERVICE-VALUE';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = base64_encode(openssl_encrypt($value, $encrypt_method, $key, 0, $iv));
        return $output;
    }



    if($_SERVER['REQUEST_METHOD']=='POST'){
        $jsonResponse;
        $json_str = file_get_contents('php://input');
        $data=json_decode($json_str,true);
        if(!empty($data['login_username']) && !empty($data['login_password'])){

            $login_user=$data['login_username'];
            $login_password=$data['login_password'];
            $remember_me=$data['rememberMe'];
            $login_password=md5($login_password);

            $user=mysqli_query($conn,"SELECT * FROM users WHERE (username='$login_user' AND password='$login_password') OR (email='$login_user' AND password='$login_password')");

            if(mysqli_num_rows($user)==1){
                $user=mysqli_fetch_array($user);
                $user_username=$user['username'];
                $user_email=$user['email'];
    
                $res=mysqli_query($conn,"UPDATE users SET online=1 WHERE username='$user_username'");
                
                if($res){
                    if($remember_me=='1'){
                        $enCookie=encryptCookie($user_username);
                        $_SESSION['timenow']=time();
                        $_SESSION['timeexpire']=time()+(1*600);
                        setcookie('remember_me',$enCookie,time()+(60*60*4),'/');
                    }
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
    else{
        header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/auth/login_register.php");
    }
