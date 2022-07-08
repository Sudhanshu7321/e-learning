 <?php
    $page = 'index';
    ob_start();
    session_start();

    require 'php/class/course.php';
    $user_id = 'n';

    if (isset($_SESSION['email'])) {
        include 'php/header_footer/login.php';
    } else {
        include 'php/header_footer/not_login.php';
    }
    ?>

 <!-- Main contain -->
 <div class="bg-img">

     <div class="container-fluid  bg-dark " style="padding-top:5%;padding-right:5%;">
         <div class="row">
             <div class="col-sm-6">
                 <div style="padding-left:10%;padding-top:15%;">

                     <h1 style="color: blanchedalmond;">
                         100% LEARNING
                     </h1>
                     <h1 style="color: blanchedalmond;">
                         PORTAL
                     </h1>
                     <h6 style="color: white;">
                         LEARN ANY COURSE FOR FREE IN YOUR OWN LANGUAGE
                     </h6>
                     <label style="align-items: center;">
                         <?php
                            if (isset($_SESSION['email'])) { ?>
                             <a href="php/pages/all_course.php"> <button type="button" class="btn btn-warning btn-lg ">Start Learning</button></a>
                         <?php  } else { ?>
                             <a href="php/login_registration/login.php"> <button type="button" class="btn btn-warning btn-lg ">Join Now</button> </a>
                         <?php   }
                            ?>
                     </label>
                 </div>
             </div>
             <div class="col-sm-6">
                 <img class="img-fluid" src="https://www.learnvern.com/images/home-assets/header-img.png" alt="">
             </div>
         </div>
     </div>
 </div>

 <!-- About -->
 <div class="container" style="text-align: center;padding-top:2%;padding-bottom:2%">
     <h1>
         <b>
             <u>
                 About LearnVern
             </u>
         </b>
     </h1>
 </div>

 <div class="row container-fluid">
     <div class="col-sm-8">
         <div style="padding:5%">
             <h2>
                 Learn Anytime, Anywhere in Any Language for Free

             </h2>
             <h5 class="container">
                 Our name LearnVern is coined from the word Learn in Vernacular Languages - LearnVern teaches students in the user's native language. Years of research have indicated that students learn the most difficult concepts easily when explained in a language they most understand and with images, examples and practical insights. Each of the subjects we teach at LearnVern is offered in vernacular languages, have perfect examples and lots of practical insights and are taught by experts in their fields.
             </h5>
         </div>
     </div>


     <div class="col-sm-4">
         <img style="float: right;" class="img-fluid" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="">

     </div>
 </div>

 <!-- Our Team -->
 <div class="card container bg-dark">

     <div class="container" style="text-align: center;padding-top:2%;padding-bottom:2%;color:white;">
         <h1>
             <b>
                 <u>
                     Our Team Members
                 </u>
             </b>
         </h1>
     </div>

     <div class="row">

         <div class="col-sm-2 col-lg-2">
             <img width="123px" class="rounded-circle" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>
         <div class="col-sm-2 col-md-2">
             <img width="123px" class="rounded-circle" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>
         <div class="col-sm-2 col-md-2">
             <img width="123px" class="rounded-circle" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>
         <div class="col-sm-2 col-md-2">
             <img width="123px" class="rounded-circle" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>
         <div class="col-sm-2 col-md-2">
             <img width="123px" class="rounded-circle" src="http://static1.squarespace.com/static/55995856e4b00f5f814211cc/t/576213bd9de4bbe3608a1116/1466045382682/?format=1500w" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>
         <div class="col-sm-2 col-md-2">
             <img width="123px" class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsQ-YHX2i3RvTDDmpfnde4qyb2P8up7Wi3Ww&usqp=CAU" alt="...">
             <h6 style="color: white;">Sudhanshu kumar</h6>
         </div>


     </div>
 </div>

 <!-- All Course-->
 <div class="container" style="text-align: center;padding-top:2%;padding-bottom:2%">
     <h1>
         <b>
             <u>
                 All Courses
             </u>
         </b>
     </h1>
 </div>

 <?php

    $obj = new Course();
    $obj->all_course($user_id);

    if (isset($_POST['enroll'])) {
        echo   $enroll =   $_SESSION['enroll'] = $_POST['enroll'];
        echo   $_SESSION['purchase'] = $_POST['purchase'];
        echo $_SESSION['price'] = $_POST['price'];
        echo   $_SESSION['mobile'] = '8541659845';
        header("location: ./php/pages/learn_course.php");
    }

    ?>


 <!-- Certificate -->
 <div class="row container-fluid">
     <div class="col-sm-6">
         <img style="float: right;" class="img-fluid" src="https://www.learnvern.com/images/Certificate.jpg" alt="">

     </div>


     <div class="col-sm-6" style="padding-top: 3%;">

         <div style="padding:5%">
             <h2>
                 Accelerate your digital skills training with <label style="color: blue;">Skillindia/ NSDC</label> Certificate
             </h2>
             <br>
             <h5 class="container">
                 SkillIndia is a campaign launched by Shri Narendra Modi to Skill and Upgrade the Students across India
             </h5>
             <ul>
                 <li>
                     Approved for Summer Training/Internships
                 </li>
                 <li>
                     Approved in Organization's For Jobs
                 </li>
                 <li>
                     Lifetime Value
                 </li>
                 <li>
                     Present Certificate at all Interviews
                 </li>
             </ul>
             <?php
                if (isset($_SESSION['email'])) { ?>
                 <a href="php/pages/all_course.php"> <button type="button" class="btn btn-warning btn-lg ">Start Learning</button></a>
             <?php  } else { ?>
                 <a href="php/login_registration/login.php"> <button type="button" class="btn btn-warning btn-lg ">Join Now</button> </a>
             <?php   }
                ?>
         </div>

     </div>
 </div>
 <!DOCTYPE html>
 <html lang=" en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
     <script>
         function on(id) {
             document.getElementById(id).style.color = "blue";

         }

         function out(id) {
             document.getElementById(id).style.color = "black";

         }
     </script>

     <title>Document</title>
 </head>

 <body class="body">

     <?php include 'php/header_footer/footer.php';
        ob_end_flush(); ?>
 </body>

 </html>

