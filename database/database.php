<?php

    $conn=mysqli_connect('localhost','root','_Am13ir75@','social_media');

    if(mysqli_connect_errno()){

        echo 'can\'t connect to database:'.mysqli_connect_errno();

    }
    else{
        echo 'connected to database';
    }

 ?>