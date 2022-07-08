   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <style>

       
       .bg-dark {
           background-image: linear-gradient(to right, rgb(71, 16, 224, 0.7), rgb(179, 9, 217, 0.7), rgb(71, 16, 224, 0.7));
           background-color: red;
           /* opacity: 0.5; */
           /* background-image: url('https://image.shutterstock.com/image-illustration/3d-white-bg-this-dynamic-260nw-245395447.jpg');
            background-repeat: no-repeat;
            background-size: cover; */
       }

       .bg-img {
           background-image: url('https://ak.picdn.net/shutterstock/videos/17315704/thumb/1.jpg');
           background-repeat: no-repeat;
           background-size: cover;
       }

       /* .body {
            background-image: linear-gradient(to right, #6208c9, white, #6208c9);

        } */

       .btn-dark {
           background-image: linear-gradient(to right, #7605ab, #6208c9);
       }

       /* .btn-primary {
           background-image: linear-gradient(to right, #6208c9, #b308c9, #6208c9);
       }

       .btn-warning {
           background-image: linear-gradient(to right, #c99608, #c9c908, #c99608);
           text-decoration-color: white;
       } */
   </style>
   <?php

    $page = basename($_SERVER['PHP_SELF']);

    if ($page == "index.php") {
        $aa = 'php';
    } else {
        $aa = '..';
    }
    ?>

   <nav class="navbar navbar-light bg-dark  fixed-top">
       <div class=" container">
           <a class="navbar-brand" href="../../">
               <img src="https://www.learnvern.com/images/logo.png" alt="" width="auto" height="auto">
           </a>


           <div class="dropdown">
               <h5 style="color: white;" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="fas fa-user"> Join Now</i></option>

               </h5>
               <!-- <button class=" btn btn-dark  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"> Join Now</i></option>
                </button> -->
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                   <li><a class="dropdown-item" href="<?php echo $aa; ?>/login_registration/login.php"><i class="fas fa-sign-in-alt"> Login</i></a></li>
                   <li><a class="dropdown-item" href="<?php echo $aa; ?>/login_registration/registration.php">Register</a></li>
               </ul>
           </div>

   </nav>