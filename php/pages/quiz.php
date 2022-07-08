<?php


session_start();
require '../class/quiz.php';
require '../class/course.php';
if (isset($_SESSION['email'])) {
    include '../header_footer/login.php';
} else {
    header('location: ../../index.php');
}
$course_id = $_REQUEST['course'];

$obj = new Quiz;
$obj->question($course_id);

if(isset($_REQUEST['result'])){
    $obj->score($course_id,$user_id);

}


?>