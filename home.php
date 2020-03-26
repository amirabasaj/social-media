<?php
 session_start();
 ob_start();
 
 require './database/database.php';
 require './auth/checkAuth_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خانه</title>
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/fonts/font-awesome/all.min.css">
    <script src="./assets/fonts/font-awesome/all.min.js"></script>
</head>
<body>
    <?php 

        require './partialViews/header.php';
        
    ?>
</body>
</html>