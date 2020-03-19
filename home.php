<?php 
 require './database/database.php';
session_start();

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
    }
}

if(!isset($_SESSION['login_username']))
{
    header('Location:./auth/login_register.php');
}
echo "hello ".$_SESSION['login_username'];
?>