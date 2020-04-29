<?php
 session_start();
 ob_start();
 
 require '../database/database.php';
 require './auth/checkAuth_handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خانه</title>
    <link rel="stylesheet" href="../../assets/css/home.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome/all.min.css">
    <link href="https://vjs.zencdn.net/7.7.5/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

</head>
<body>
    <?php 

        require './partialViews/header.php';
        
    ?>

    <section class="container">
        <div class="container-main">

            <div class="container-main-posts">
                <div class="container-main-posts-item ">
                    <div class="container-main-posts-item_header">
                        <video
                        class="video-js"
                        controls
                        preload="auto"
                        poster="../assets/img/login_register-background.jpg"
                        data-setup="{}"
                        >
                            <source src="../assets/video/small.mp4" type="video/mp4" />
                        </video>
                    </div>
                    <div class="container-main-posts-item_body">  
                        <h3 >نویسنده: امیرعباس آجودانی</h3>
                        <p>الورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای گیرد.</p>
                        <h4 class="mt-3">تگ ها : <span>#تگ 1</span> <span>#تگ 2</span></h4>
                    </div>                    
                    <div class="container-main-posts-item_footer">
                       <a href="#" class="container-main-posts-item_footer_icon">
                       <i class="fas fa-heart "></i><span>3</span>
                       </a>
                       <a href="#" class="container-main-posts-item_footer_view-btn">مشاهده کامل</a>
                    </div>
                  
                </div>
                <div class="container-main-posts-item ">
                    <div class="container-main-posts-item_header">
                        <img src="../assets/img/login_register-background.jpg" class="container-main-posts-item_header_img">
                    </div>
                    <div class="container-main-posts-item_body">
                        <h3>نویسنده: امیرعباس آجودانی</h3>
                        <p>الورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای گیرد.</p>
                        <h4 class="mt-3">تگ ها : <span>#تگ 1</span> <span>#تگ 2</span></h4>
                    </div>                    
                    <div class="container-main-posts-item_footer">
                       <a href="#" class="container-main-posts-item_footer_icon">
                       <i class="fas fa-heart "></i><span>3</span>
                       </a>
                       <a href="#" class="container-main-posts-item_footer_view-btn">مشاهده کامل</a>
                    </div>
                  
                </div>
            </div>
            <div class="container-main-searchbox">

                <form class="container-main-searchbox-form">
                    <h3 class="text-align-center mt-3">جست و جو</h3>
                    <ul class="container-main-searchbox-form-tags">
                        <h4 class=" mt-3">تگ ها:</h4>
                        <li>
                        <label for="rememberMe" class="primary__checkbox">
                            <span>علمی</span>
                            <input type="checkbox" name="remember_me" id="rememberMe" value="0">
                        </label>
                        </li>
                        <li>
                        <label for="rememberMe" class="primary__checkbox">
                            <span>ورزشی</span>
                            <input type="checkbox" name="remember_me" id="rememberMe" value="0">
                        </label>
                        </li>
                        <li>
                        <label for="rememberMe" class="primary__checkbox">
                            <span>اقتصادی</span>
                            <input type="checkbox" name="remember_me" id="rememberMe" value="0">
                        </label>
                        </li>
                        <li>
                        <label for="rememberMe" class="primary__checkbox">
                            <span>سیاسی</span>
                            <input type="checkbox" name="remember_me" id="rememberMe" value="0">
                        </label>
                        </li>
                    </ul>
                    <div class="container-main-searchbox-form-author  mb-3 mt-3">
                        <label for="author-search-input"><h4>نام نویسنده:</h4></label>
                        <input type="text" name="author-search-input">
                    </div>           
                     <div class="container-main-searchbox-form-username mb-3">
                        <label for="username-search-input"><h4>ای دی نویسنده:</h4></label>
                        <input type="text" name="username-search-input">
                    </div>

                    <button type="submit" class="container-main-searchbox-form-submit">جستجو</button>
                </form>
                <div class="container-main-searchbox-advertising">
                    تبلیعات
                </div>
            </div>


        </div>
    </section>

    <script src="../../assets/fonts/font-awesome/all.min.js"></script>  
    <script src="https://vjs.zencdn.net/7.7.5/video.js"></script>
    <script src="../../assets/js/home.js"></script>
</body>
</html>