<?php
 ob_start();
 $http=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http"); $actual_link = $http. "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 function decryptCookie($value){
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'WS-SERVICE-KEY';
    $secret_iv = 'WS-SERVICE-VALUE';

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
    return $output;
}

if(isset($_COOKIE['remember_me'])){
    $user=decryptCookie($_COOKIE['remember_me']);
    $res=mysqli_query($conn,"SELECT username,email FROM Users WHERE username='$user'");
    if(mysqli_num_rows($res)==1){
        $user=mysqli_fetch_array($res);

        $_SESSION['login_username']=$user['username'];
        $_SESSION['login_email']=$user['email'];
       
        
        if($actual_link!=$http."://$_SERVER[HTTP_HOST]/home.php"){
            header("Location:$http://$_SERVER[HTTP_HOST]/home.php");
        }
    }
}

else if(isset($_SESSION['login_username']))
{
    if($actual_link!=$http."://".$_SERVER['HTTP_HOST']."/home.php"){
        header("Location:".$http."://".$_SERVER['HTTP_HOST']."/home.php");
    }

}
else{

    if($actual_link!=$http."://".$_SERVER['HTTP_HOST']."/auth/login_register.php"){
        header("Location:".$http."://".$_SERVER['HTTP_HOST']."/auth/login_register.php");
    }
}

ob_end_clean();
?>