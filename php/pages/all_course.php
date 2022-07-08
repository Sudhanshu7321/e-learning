
<?php
session_start();
    ob_start();
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
require '../class/course.php';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    include '../header_footer/login.php';
} else {
    header('location: ../../index.php');
}


$obj = new Course();
$obj->all_course($user_id);
    



//     if (isset($_POST['enroll'])) {
//         $_SESSION['enroll'] = $_POST['enroll'];
//          $_SESSION['purchase'] = $_POST['purchase'];
//      $_SESSION['price'] = $_POST['price'];
//    $_SESSION['course_id'] =   $course_id ;
//      $_SESSION['user_id'] = $user_id;

//        header("location: learn_course.php");
//     }
    ob_end_flush();
?>



   

    


    <?php include '../header_footer/footer.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
