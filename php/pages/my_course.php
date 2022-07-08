<?php
session_start();
    ob_start();
    
require '../class/course.php';

if (isset($_SESSION['email'])) {
    include '../header_footer/login.php';
} else {
    header('location: ../../index.php');
}


$obj = new Course();
$obj->my_course($user_id,$user_name, 'my_course');


// if(isset($_REQUEST['certificate'])){
    
//     // require '../../images/certificate/certificate.php';
//     // $obj = new Certificate('xggggyz', 'ms word');

//     // $font = "C:\Users\sudhanshu\Downloads\arial\arial.ttf";
//     // $image = imagecreatefromjpeg("certificate.jpg");
//     // $color = imagecolorallocate($image, 19, 21, 22);
//     // imagettftext($image, 110, 0, 1230, 1180, $color, $font, $user_name);
//     // imagettftext($image, 60, 0, 2020, 1409, $color, $font, $title);
//     // $file = time();
//     // imagejpeg($image, $file . ".jpg");
//     // imagedestroy($image);
//     // echo "<script> alert('Certificate click')</script>";

// }

    if (isset($_POST['enroll'])) {
    //  course_id  
     $_SESSION['enroll'] = $_POST['enroll'];
    // price
   echo $_SESSION['price'] = $_POST['price'];

         $_SESSION['purchase'] = $_POST['purchase'];
        header("location: learn_course.php");
    }
    ob_end_flush();
 include '../header_footer/footer.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">