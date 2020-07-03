<?php

session_start();

require '../database/database.php';
require './auth/checkAuth_handler.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  session_destroy();
  if(isset($_COOKIE['remember_me'])) {
    
    unset($_COOKIE['remember_me']); 
    setcookie('remember_me', null, -1, '/');
     
  }
  
	header("Location:$http://$_SERVER[HTTP_HOST]/social-media/app/auth/login_register.php");
  
}