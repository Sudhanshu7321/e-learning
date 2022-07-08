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
$obj->my_course($user_id,$user_name, 'bill');
// $percent = $obj->percent;
// $url = $obj->link;
// $title = $obj->title;
// $short_description = $obj->short_dec;



if (isset($_POST['order_id'])) {
    //  order_id  
  echo  $_SESSION['order_id'] = $_POST['order_id'];
    header("location:../paytm/PaytmKit/TxnStatus.php");
}



ob_end_flush();
include '../header_footer/footer.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

