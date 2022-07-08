<?php
include '../class/course.php';

session_start();

echo '<br><br>';
$user_id = '';
$one = '';

if (!isset($_SESSION['purchase'])) {
    header("location: ../..");
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    include '../header_footer/login.php';
} else {
    include '../header_footer/not_login.php';
}

if (isset($_SESSION['enroll'])) {
    $course_id = $_SESSION['enroll'];
} else {
    $course_id = $_REQUEST['enroll'];
}
echo '<br><br>';
$purchase = $_SESSION['purchase'];



if (isset($_REQUEST['checkout'])) {
    header("location: ../paytm/");
}

//================Call function mark=================================\\
if (isset($_SESSION['content_id'])) {
    $content_id = $_SESSION['content_id'];
    if (isset($_REQUEST['mark'])) {
        $mark = new Course();
        $mark->mark($course_id, $content_id, $user_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        function f() {
            return false;
        }

        function mark() {
            document.getElementById("demo").style.color = "green";
            confirm(" <?php echo "hii i ma" ?>");

        }


        function about() {
            document.getElementById("about").style.color = "blue";
            document.getElementById("about").style.fontSize = "30px";
            document.getElementById("contain_body").style.display = 'none';
            document.getElementById("video").style.display = 'none';

        }



        function display(active, deactive, active_body, deactive_body) {
            document.getElementById(active).style.color = "blue";
            document.getElementById(active).style.fontSize = "30px";
            document.getElementById(active_body).style.display = 'block';

            document.getElementById(deactive).style.color = "black";
            document.getElementById(deactive).style.fontSize = "20px";
            document.getElementById(deactive_body).style.display = 'none';
        }
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Document</title>
</head>

<body onload="about()">



    <?php
    $obj = new Database();
    $where = "course_id = '$course_id'";
    $obj->select('course_title', '*', null, $where, null, null);
    $result = $obj->getResult();


    foreach ($result as list("title" => $title, "description" => $description, "short_description" => $short_description, 'image_url' => $url, 'price' => $price)) {
    }
    $a = '../../images/' . $url;




    ?>

    <!-- =========================== IF AND ELSE FOR VIDEO OR COURSE ========================== -->
    <?php
    if (isset($_POST['link'])) {
        $_SESSION['video'] = $video_link = $_POST['link'];
        $content_id = $_SESSION['content_id'] = $_POST['content_id'];
        $title_content  = $_POST['title'];
        $about  = $_POST['about'];
        $pdf_url  = $_POST['pdf_url'];


        echo "<script> display('contain','about','contain_body','about_body') </script>";

        echo "<script>  </script>";

    ?>
        <div class="card card-footer" style="margin: 5%;">
            <div class="row">
                <div class="col-sm-6">

                    <video width="100%" controls controlslist="nodownload">
                        <source src="../../videos/<?php echo $video_link  ?>" type="video/mp4">
                    </video>
                    <div style="background-color: white;padding:1%;width:50%">
                        <i class="fas fa-play-circle" style="font-size:30px;color:green;">
                            <label style="font-size:25px;color:green;"><?php echo $title_content  ?></label>
                        </i>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div style="margin: 1%;background-color:white;padding:2%">
                        <div style="float: right;padding-left:1%">
                            <?php
                            if ($user_id != '') {

                                if ($purchase == 0) {
                                    echo '<button name="enroll" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" value="' . $course_id . '">Rs: ' . $price . ' ' . 'Enroll now</button>
                            ';
                                } else {
                                    $check_mark = new Course();
                                    $count =  $check_mark->check_mark($course_id, $content_id, $user_id);
                                }
                            } else {
                                echo '<a href="../login_registration/login.php"><button name="enroll" type="submit" class="btn btn-primary" value="' . $course_id . '">Rs: ' . $price . ' ' . 'Enroll now</button></a>';
                            }
                            ?></div>
                        <h5><?php echo $title ?></h5>
                        <hr>
                        <p><?php echo $about ?></p>
                        <a href="../../pdf/<?php echo $pdf_url; ?>" target="_blank">Pdf</a>
                    </div>
                </div>
            </div>
        </div>
        <?php

    } else {

        if (isset($_SESSION['purchase'])) {
        ?>

            <div>
                <div style="padding-left: 15%;">
                    <div class="card " style="width: 85%;">
                        <div class="card-body">
                            <img src="<?php echo $a ?>" class="img-fluid" alt="Responsive image" style="float: right;padding-left: 1rem">
                            <h5 class="card-title"> <?php echo $title ?> </h5>
                            <p class="card-text"><?php echo $short_description ?></p>
                            <?php if ($purchase == 1) {
                                $obj = new Course;
                                $val =   $obj->percentage($course_id, $user_id);
                                $percent = $val . '%';
                                if ($percent == 'NAN%') {
                                    $percent = "0%";
                                }
                            ?>

                                <div class="progress" style="background-color: #959399">
                                    <div class="progress-bar bg-dark" role="progressbar" style="width:  <?php echo $percent; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <?php echo $percent . '  ';  ?>complete</div>
                                </div>
                            <?php
                            } else if ($user_id == '') { ?>
                                <a href="../login_registration/login.php"> <button name="enroll" type="button" class="btn btn-primary">Rs: <?php echo $price . ' ' . 'Enroll now'; ?></button> </a>

                            <?php } else {
                            ?>
                                <button name="enroll" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Rs: <?php echo $price . ' ' . 'Enroll now'; ?></button>
                            <?php
                            } ?>


                        </div>
                    </div>
                </div>
            </div>

    <?php  // cut from here  else part
        }
    }
    ?>


    <center>
        <label id="about" onclick="display('about','contain','about_body','contain_body')">
            About
        </label>
        <label id="contain" onclick="display('contain','about','contain_body','about_body')">
            Contain
        </label>
    </center>

    <div id="about_body">
        <?php
        echo '<div style="padding:5%;">
        <div class="card card-footer" style="padding:2%;" >
        <h4>' . $title . '</h4>
        <div style="background-color: white;padding:2%;">
        <p>' . $description . '</p>
        </div>
        </div>
        </div>';

        ?>


    </div>

    <div id="contain_body" style="margin: 5%;">

        <form action="" method="POST">
            <ul>
                <?php
                echo '<div class="card card-footer" style="padding:3%;">';

                $obj = new Database();
                $where = "course_id = '$course_id'";
                $obj->select('course_content', '*', null, $where, null, null);
                $result = $obj->getResult();
                if ($obj->row("SELECT * FROM purchase WHERE user_id = '$user_id' AND course_id = '$course_id' AND status = 1")) {
                    echo '<div style="background-color:white;  padding:1%""><table >';
                    foreach ($result as list("title" => $title, "link" => $link, "course_content_id" => $course_content_id, 'about' => $about, 'pdf' => $pdf_url)) {
                        //=======================UN-LOCK===============================\\                          

                        // echo '<ul>';
                        echo    '<i class="fas fa-play-circle"  style="font-size:30px;color:green;"></i>';
                        echo    '<form action="" method="post">
                                   <input type="hidden" name="content_id" value="' . $course_content_id . '">
                                     <input type="hidden" name="title" value="' . $title . '">
                                                                          <input type="hidden" name="about" value="' . $about . '">
                                     <input type="hidden" name="pdf_url" value="' . $pdf_url . '">

                                   <button   type="submit" style="border: none; background-color: white; font-size: 16px;" name="link" value="' . $link . '">' . $title . '</button>
                                   </form>';
                        echo    '<br>';
                        echo    '<br>';

                        // echo '</ul>';
                    }

                    $obj = new Course;
                    $val =   $obj->percentage($course_id, $user_id);
                    $percent = $val . '%';
                    if ($percent == 'NAN%') {
                        $percent = "0%";
                    }
                    if ($percent == "100%") {

                        echo '<i class="far fa-file-alt" style="font-size:30px;color:green;"><a style="color:black" href="quiz.php?course=' . $course_id . '" target="_blank">Quiz</a></i>';
                    } else {
                        echo    '<i class="fas fa-user-lock" style="font-size:30px;color:black;">Quiz (Compleat course 100% )</i> ';
                    }

                    echo '</table></div>';
                } else {
                    $one = 0;
                    echo '<div style="background-color:white;  padding:1%"><table >';

                    foreach ($result as list("title" => $content_title, "link" => $link, "course_content_id" => $course_id)) {
                        if ($one == 0) {
                            //=======================UN-LOCK ONE TIME===============================\\                          
                            echo '<ul>';
                            echo    '<i class="fas fa-play-circle" style="font-size:30px;color:green;"></i>';

                            echo    '<form action="" method="post">
                                   <input type="hidden" name="content_id" value="' . $course_id . '">
                                    <input type="hidden" name="title" value="' . $title . '">
                                   <button   type="submit" style="border: none; background-color: white; font-size: 16px;" name="link" value="' . $link . '">' . $title . '</button>
                                   </form>';
                            echo '</ul>';

                            $one = 1;
                        } else {
                            //=======================LOCK===============================\\                          
                            echo '<ul >';
                            echo    '<i class="fas fa-user-lock" style="font-size:30px;color:black;"></i>';
                            echo    '<button type="button"  style="border: none; background-color: white; font-size: 16px;" name="link" >' . $content_title . '</button>';
                            echo '</ul>';
                        }
                    }
                    echo '</table></div>';
                }
                echo '</div>';

                ?>

            </ul>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>

                    <button type="button" style="background-color: white;" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <h5> <?php echo $title ?></h5>

                    <img src="<?php echo $a ?>" class="img-fluid" height="50%" width="50%" alt="Responsive image" style="float: right;padding-top: 0.5rem">

                    <table border="0px">
                        <tr>
                            <td>Price:</td>
                            <td> Rs. <?php echo $price  ?></td>
                        </tr>
                        <tr>
                            <td>Discount:</td>
                            <td> Rs. 00.0</td>
                        </tr>
                        <tr>
                            <td>Tax:</td>
                            <td> Rs. 00.0</td>
                        </tr>
                        <tr>
                            <td>
                                <hr>Total:
                            </td>
                            <td>
                                <hr>
                                Rs. <?php echo $price  ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="footer-page">
                    <?php
                    if ($user_id != '') {
                        include '../paytm/index.php';
                    } ?>

                </div>
            </div>
        </div>
    </div>
    <?php include '../header_footer/footer.php';
    ?>
</body>

</html>