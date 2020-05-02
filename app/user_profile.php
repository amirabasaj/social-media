<?php

session_start();
 require '../database/database.php';
 require './auth/checkAuth_handler.php';


 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../assets/css/user_profile.css">
    <link rel="stylesheet" href="../../assets/fonts/font-awesome/all.min.css">
    <link href="../../assets/videojs/video-js.css" rel="stylesheet" />
    <script src="../../assets/videojs/videojs-ie8.min.js"></script>
    <script src="../../assets/ckeditor/ckeditor.js"></script>
    <script src="../../assets/slim-select/slimselect.min.js"></script>
    <link href="../../assets/slim-select/slimselect.min.css" rel="stylesheet">
    </link>
     <title>پروفایل</title>
 </head>
 <body>

     <?php require './partialViews/header.php';?>
    <section class="profile"> 
        <ul class="profile-tab-nav">
            <li><a class="active" href="#" data-box="change-info">تغیر اطلاعات</a></li>
            <li><a href="#" data-box="see-statistics">مشاهده پست ها</a></li>
            <li><a href="#"  data-box="add-post">افزودن پست جدید</a></li>
        </ul>
        <div class="profile-tab show" id="change-info">
          
           <form class="change-info-form">
               <div>
                   <label for="old-password">رمز عبور قبلی</label> 
                   <input placeholder="رمز عبور قبلی را وارد کنید" type="password" name="old-password"  class="primary-input mt-2 mb-2">
   
                   <label for="new-password">رمز عبور جدید</label>
                   <input placeholder="رمز عبور جدید را وارد کنید" type="password" name="new-password"  class="primary-input mt-2 mb-2">
               </div>
               <div class="change-info-form-submit">
               <button class="change-info-form-submit_btn">تغییر رمز</button>
               </div>
           </form>
           <form class="change-image-form">
               <div>
                   <input  type="file" id="image-file"  name="image"  class="mt-2 mb-2">
                   <label for="image-file" >انتخاب عکس</label> 
               </div>
               <div class="change-image-form-submit">
               <button class="change-image-form-submit_btn">تغییر عکس</button>
               </div>
           </form>
        </div>
        <div class="profile-tab" id="see-statistics">
           
          <div class="see-statistics-box">
                <div class="see-statistics-box-item">
                    <div class="see-statistics-box-item_header">
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
                    <div class="see-statistics-box-item_body">
                        <p>الورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای گیرد.</p>
                    </div>
                    <div class="see-statistics-box-item_footer">
                        <a><i class="fas fa-comment"></i><span  class="mr-1">2</span></a>
                        <a><i class="fas fa-heart"></i><span class="mr-1">3</span></a>
                        <a><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <div class="see-statistics-box-item">
                    <div class="see-statistics-box-item_header">
                        <img src="../assets/img/login_register-background.jpg" >
                    </div>
                    <div class="see-statistics-box-item_body">
                        <p>الورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای گیرد.</p>
                    </div>
                    <div class="see-statistics-box-item_footer">
                        <a><i class="fas fa-comment"></i><span  class="mr-1">2</span></a>
                        <a><i class="fas fa-heart"></i><span class="mr-1">3</span></a>
                        <a><i class="fas fa-trash"></i></a>
                    </div>
                </div>            
                <div class="see-statistics-box-item">
                    <div class="see-statistics-box-item_header">                        
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
                    <div class="see-statistics-box-item_body">
                        <p>الورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای گیرد.</p>
                    </div>
                    <div class="see-statistics-box-item_footer">
                        <a><i class="fas fa-comment"></i><span  class="mr-1">2</span></a>
                        <a><i class="fas fa-heart"></i><span class="mr-1">3</span></a>
                        <a><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-tab" id="add-post">
          
           <div class="add-post-box">
            <form class="add-post-box-form">

                <label for="title">سر تیتر</label> 
                <input placeholder="تیتر پست را وارد کنید..." type="text" name="title"  class="primary-input mt-1 mb-5">

                <div>
                   <input  type="file" id="post-file"  name="media" >
                   <label for="post-file" class="image-label mt-2 mb-5" >انتخاب عکس</label> 
               </div>

                <textarea name="message" id="myEditor" rows="10" cols="80">
                     متن پست خود را وارد کنید...
                </textarea>
                <script>
                    CKEDITOR.replace( 'myEditor' );
                </script>
                <label for="mySelect" >انتخاب تگ ها</label> 
                <select  name="tags" style="width: 300px" multiple class="mt-5 mb-5" id="mySelect">
                    <option value="elmi">علمی</option>
                    <option value="varzeshi">ورزشی</option>
                    <option value="eghtesadi">اقتصادی</option>
                    <option value="siyasi">سیاسی</option>
                </select>
            </form>
           </div>
        </div>
    </section>
    <script src="../../assets/fonts/font-awesome/all.min.js"></script>   
    <script src="../../assets/videojs/video.js"></script>
    <script src="../../assets/js/user_profile.js"></script>
 </body>
 </html>