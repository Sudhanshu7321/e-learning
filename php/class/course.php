<?php
require 'database.php';

class Course
{
  // ================================================================\\
  //    function certificate($name,$course){
  // 	$font = "C:\Users\sudhanshu\Downloads\arial\arial.ttf";
  // 	$image=imagecreatefromjpeg("certificate.jpg");
  // 	$color=imagecolorallocate($image,19,21,22);
  // 	imagettftext($image,110,0,1230,1180,$color,$font,$name);
  // 	imagettftext($image,60,0,2020,1409,$color,$font,$course);
  // 	$file=time();
  // 	imagejpeg($image,$file.".jpg");
  // 	imagedestroy($image);
  // }
  // ================================================================\\
  function check_mark($course_id, $content_id, $user_id)
  {
    $check_mark = new Database();
    $count = $check_mark->row_num("SELECT * FROM learn_content WHERE   content_id = $content_id And course_id = $course_id And user_id = $user_id");
    // echo 'content'.$content_id;
    // echo  ' course'.$course_id;
    // echo ' user'.$user_id; 
    if ($count != 1) {
      echo '  <form action="" method="post">
                <button type="submit" name="mark" class="btn btn-success" value="h">Mark as complete</button> <br>
            </form>';
    } else {
      echo '<i class="fas fa-check-circle" style="color: green;padding-top:1.5%;"> Completed</i>  ';
    }
  }

  function mark($course_id, $content_id, $user_id)
  {
    $mark = new Database();
    if ($mark->insert('learn_content', ['user_id' => $user_id, 'course_id' => $course_id, 'content_id' => $content_id])) {
      // echo "<script> alert('done')</script>";
    } else {
      // echo "<script> alert(' not done')</script>";

    }
  }
  // ================================================================\\


  // ================================================================\\

  function user_details($email)
  {
    $user = new Database();
    $where = "email = '$email'";
    $user->select('user', '*', null, $where, null, null);
    $result = $user->getResult();
    foreach ($result as list("email" => $email_id, "id" => $user_id, "name" => $user_name, "mobile_no" => $mobile_no)) {

      $this->email_id = $email_id;
      $this->user_name = $user_name;
      $this->user_id = $user_id;
      $this->mobile_no = $mobile_no;
    }
  }

  function    profile_update($email, $current_password, $name, $mobile_no)
  {
    $update = new Database();
    if ($update->row_num("SELECT * FROM user WHERE email = '$email' And password = '$current_password'")) {

      $update->update('user', ['mobile_no' => $mobile_no, 'name' => $name], 'email="' . $email . '"');
      $this->s_msg = 'Profile update is successfully ';
      $this->msg = '';
      header('location: ../pages/my_profile.php');
    } else {
      $this->msg = 'Current password is wrong.';
      $this->s_msg = '';
    }
  }

  function password_update($email, $current_password, $new_password, $re_new_password)
  {
    if ($new_password == $re_new_password) {
      $update = new Database();
      if ($update->row_num("SELECT * FROM user WHERE email = '$email' And password = '$current_password'")) {

        $update->update('user', ['password' => '' . $new_password . ''], 'email="' . $email . '"');
        $this->s_msg = 'Password successfully change.';
        $this->msg = '';
      } else {
        $this->msg = 'Current password is wrong.';
        $this->s_msg = '';
      }
    } else {
      $this->msg = 'New password and Re-new password did not match';
      $this->s_msg = '';
    }
  }

  // ================================================================\\


  // ================================================================\\

  function percentage($course_id, $user_id)
  {
    $total_course = new Database();
    $total =  $total_course->row_num("SELECT * FROM course_content WHERE course_id = $course_id");

    $complete_course = new Database();
    $complete =  $complete_course->row_num("SELECT * FROM learn_content WHERE course_id = $course_id AND user_id = $user_id ");

    $total;
    echo '<br>';
    $complete;
    $total = $complete / $total * 100;
    return round($total, 2);
  }



  function my_course($user_id, $user_name, $page)
  {
    $var = 0;
    $obj = new Database();

    $count = $obj->row_num("SELECT * FROM purchase WHERE user_id = $user_id AND status = 1");
    if ($count >= 1) {

      $column = '*';
      $where = 'user_id =' . $user_id . ' AND  status = 1';
      $join = "course_title ON course_title.course_id = purchase.course_id";
      $obj->select('purchase', $column, $join, $where, null, null);
      $result = $obj->getResult();
      echo "<br><br><br><br>";

      foreach ($result as list("price" => $price, "short_description" => $short_dec, "image_url" => $img_url, "title" => $title, "order_id" => $order_id, "course_id" => $course_id)) {
        // echo $short_dec;
        if ($page == 'my_course') {

          if (1 == 1) {
            $obj = new Course;
            $val =   $obj->percentage($course_id, $user_id);
            $percent = $val . '%';
            if ($percent == 'NAN%') {
              $percent = "0%";
            }
            $percent;
            $img_url;
            $title;
            $short_dec;

            $a = '../../images/' . $img_url;



            echo '<div style="padding-left: 15%;">
        <div class="card " style="width: 85%;">
            <div class="card-body">
            <img src="' . $a . '" class="img-fluid" alt="Responsive image" style="float: right;padding-left: 1rem">
                <h5 class="card-title">' . $title . '</h5>
                <p class="card-text">' . $short_dec . '</p>
                <div class="progress " style="background-color: #959399">
                    <div class="progress-bar bg-dark" role="progressbar" style="width:' . $percent . ';" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">' . $percent . '  ' . ' complete</div>
                    </div> 
                       <div style="float: left;">
                       <br>
                        <form action="" method="post">
                         <input type="text" name="purchase"  value="1"  hidden>
                         <input type="text" hidden name="price" value="' . $price . '">
                   <tr>';
            if ($percent == "100%") {

              $quiz = new Database();
              $where = 'course_id = ' . $course_id . ' And user_id = ' . $user_id;
              $quiz->select('quiz_score', '*', null, $where, null, null);
              $result = $quiz->getResult();
              foreach ($result as list('w_question' => $w_ans, 'r_question' => $r_ans, 'attempts' => $attemps)) {
                $total = $w_ans + $r_ans;
                $quiz_percent = $r_ans / $total * 100;
                echo '<div class="card-footer"> Total questions =' . $total . ',';
                echo '  ' . $attemps . ' Attemps,';
                echo ' wrong =' . $w_ans . ',';
                echo ' Right =' . $r_ans . ',';
                echo ' Score =' . $quiz_percent . '%
                </div>';

                
                echo '</div> <div style="float: right;"><br>';
                if ($quiz_percent >= 80) {
                  $font = "C:\Users\sudhanshu\Downloads\arial\arial.ttf";
                  $image = imagecreatefromjpeg("../../images/certificate/certificate.jpg");
                  $color = imagecolorallocate($image, 19, 21, 22);
                  imagettftext($image, 110, 0, 1230, 1180, $color, $font, $user_name);
                  imagettftext($image, 60, 0, 2020, 1409, $color, $font, $title);
                  $file = time();
                  $location = "../../images/certificate/" . $user_name . " " . $title . ".jpg";
                  imagejpeg($image, $location);
                  imagedestroy($image);
                  echo '<a class="btn btn-success" href="' . $location . '" target="_blank"> Certificate</a>';
                }
              }

              // <td><button name="certificate" type="submit"  class="btn btn-success"  >Certificate</button></td>


              // echo "<script> alert('Certificate click')</script>";

            }
            echo   ' <td><button name="enroll" type="submit"  class="btn btn-success" value="' . $course_id . '" >Start learning</button></td>

                   </tr>
                  </form>           
                </div>             
            </div>
        </div>
    </div>  ';
          }
        } else {
          $var += 1;
          if ($var == 1) {
            echo '<div style="padding-top: 8%;padding-left: 3%;padding-right: 3%;">
            <table class="table table-striped" >
  <thead>
    <tr>
      <th scope="col">SN</th>
      <th scope="col">Course</th>
      <th scope="col">Price</th>
      <th scope="col">Invoice</th>
    </tr>
  </thead>';
          }
          echo '
   <tr>
      <th scope="row">' . $var . '</th>
      <td>' . $title . '</td>
      <td>' . $price . '</td>
      <td>
      <form method="POST">
      <button name="order_id" type="submit" value="' . $order_id . '"  class=" btn btn-success">Invoice</button>
      </form>
      </td>
    </tr>';
        }
      }
      echo '</table> </div>';

      echo "<br><br>";
    } else {
      echo '<center>
     <div style="padding-top: 4%;">
        <div class="fluid">
            <div class="card-body" style="height: 405px;">
                <div class="card text-end" style="width: 80%;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <h4>You are not enrolled in any courses</h4>
                            <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                            <div style="float: right;">
                                <a href="#" class="btn btn-primary">Enroll Now</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </center>';
    }
  }
  // ================================================================\\


  // ================================================================\\
  function all_course($user_id)
  {

    $obj = new Database();
    $obj->select('course_title', '*', null, null, null, null);
    $result = $obj->getResult();

    foreach ($result as list("course_id" => $course_id, "title" => $title, "short_description" => $short_description, 'image_url' => $url, 'price' => $price)) {
      $page = basename($_SERVER['PHP_SELF']);

      if ($page == 'index.php') {
        $a = 'images/' . $url;
      } else {
        $a = '../../images/' . $url;
      }

      if ($user_id != 'n') {
        if ($obj->row("SELECT * FROM purchase WHERE user_id = '$user_id' AND course_id = '$course_id' AND  status = 1 ")) {
          echo   '<div style="padding-left: 15%;">
       <div class="card " style="width: 85%;">
         <div class="card-body">
             <img src="' . $a . '" class="img-fluid" alt="Responsive image" style="float: right;padding-left: 1rem">
             <h5 class="card-title">' . $title . '</h5>
             <p class="card-text">' . $short_description . '</p>

             <form action="" method="post">
               <input type="text" name="purchase"  value="1"  hidden>
               <input type="text" hidden name="price" value="' . $price . '">
            <button name="enroll" type="submit"  class="btn btn-success" value="' . $course_id . '" >Start learn</button>
           </form>       
            </div>
           </div> 
             </div> 
     <br>';
        } else {
          echo   '<div style="padding-left: 15%;">
       <div class="card " style="width: 85%;">
         <div class="card-body">
             <img src="' . $a . '" class="img-fluid" alt="Responsive image" style="float: right;padding-left: 1rem">
             <h5 class="card-title">' . $title . '</h5>
             <p class="card-text">' . $short_description . '</p>
             <form action="" method="post">
                            <input type="text" name="purchase"  value="0"  hidden>
                          <input type="text" hidden name="price" value="' . $price . '">

            <button name="enroll" type="submit"  class="btn btn-primary" value="' . $course_id . '" >Rs: ' . $price . '  ' . 'Enroll now</button>
           </form>       
            </div>
           </div> 
             </div> 
     <br>';
        }
      } else {
        echo   '<div style="padding-left: 15%;">
       <div class="card " style="width: 85%;">
         <div class="card-body">
             <img src="' . $a . '" class="img-fluid" alt="Responsive image" style="float: right;padding-left: 1rem">
             <h5 class="card-title">' . $title . '</h5>
             <p class="card-text">' . $short_description . '</p>
             <form action="" method="post">
               <input type="text" name="purchase"  value="0"  hidden>

            <button name="enroll" type="submit"  class="btn btn-primary" value="' . $course_id . '" >Rs: ' . $price . '  ' . 'Enroll now</button>
           </form>       
            </div>
           </div> 
             </div> 
     <br>';
      }
    }
    if (isset($_POST['enroll'])) {
      $_SESSION['enroll'] = $_POST['enroll'];
      $_SESSION['purchase'] = $_POST['purchase'];
      $_SESSION['price'] = $_POST['price'];
      $_SESSION['course_id'] =   $course_id;
      $_SESSION['user_id'] = $user_id;

      header("location: learn_course.php");
    }
  }

  // ================================================================\\


}
