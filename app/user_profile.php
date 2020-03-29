<?php

session_start();
 require '../database/database.php';
 require './auth/checkAuth_handler.php';



 if(empty($_GET['userId'])|| $_GET['userId']=='' || !number_format($_GET['userId'])){
     
     header("Location:".$http."://$_SERVER[HTTP_HOST]/app/home.php");
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../assets/css/user_profile.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome/all.min.css">
     <title>پروفایل</title>
 </head>
 <body>

     <?php require './partialViews/header.php';?>
 
    <script src="../../assets/fonts/font-awesome/all.min.js"></script>
 </body>
 </html>