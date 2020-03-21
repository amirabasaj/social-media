<?php
 session_start();
 require './database/database.php';
 require './auth/checkAuth_handler.php';
echo "hello ".(isset($_SESSION['login_username']) ? $_SESSION['login_username']:'');
?>