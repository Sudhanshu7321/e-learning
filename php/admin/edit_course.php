<?php

use function PHPSTORM_META\type;
$connect = mysqli_connect("localhost", "root", "", "course");  

ob_start();
session_start();
include '../header_footer/admin.php';

require '../class/Admin.php';
if(isset($_SESSION['course_id'])){
  $course_id = $_SESSION['course_id'];

}
//============== Add New Course FORM=================\\
if (isset($_REQUEST['add_course'])) {
  $_SESSION['type']= "add_course";
  echo '<div  style="padding:5%">
  <form action="edit_course.php" enctype="multipart/form-data" method="POST">
  <div class="card card-footer" style="padding:2%">
Title: <input class="form-control" type="text" name="title" required><br>
Price: <input class="form-control" type="text" name="price" required><br>
Image:<input  type="file" name="image" required><br>
Short Description:  <textarea class="form-control" name="Short_des" id="" cols="30" rows="10" required></textarea><br>
Long Description: <textarea class="form-control" name="long_des" id="" cols="30" rows="10" required></textarea><br>
<button class="btn btn-success"  name="add_course_details" type="submit" >Add Course</button>
</form></div></form></div>';
}
//=================ADD NEW COURSE (TITLE)===============================\\
if (isset($_REQUEST['add_course_details'])) {

  $title =  $_REQUEST['title'];
  $price =   $_REQUEST['price'];
  $Short_des = $_REQUEST['Short_des'];
  $long_dse = $_REQUEST['long_des'];
  echo $size =  $_FILES['image']['size'];
  if ($size != 0) {
    print_r($_FILES);
    $file_tmp = $_FILES['image']['tmp_name'];
    $type = basename($_FILES['image']['type']);
    $time = time();
    $image = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../images/" . $image);
  }
  $insert = new Database();
  if($insert->insert('course_title', ['title' => $title, 'description' => $long_dse, 'short_description' => $Short_des, 'image_url' => $image, 'price' => $price])){
    header('location: index.php');

  }
}
//================UPDATE TITLE DETAILS==================================\\
if (isset($_REQUEST['update'])) {

  $title =  $_REQUEST['title'];
  $price =   $_REQUEST['price'];
  $image =  $_REQUEST['image_url'];
  $Short_des = $_REQUEST['Short_des'];
  $long_dse = $_REQUEST['long_des'];
  echo $size =  $_FILES['image']['size'];
  if ($size != 0) {
    print_r($_FILES);
    $file_tmp = $_FILES['image']['tmp_name'];
    $type = basename($_FILES['image']['type']);
    $time = time();
    $image = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../images/" . $image);
  }
  $update = new Database();
  if($update->update('course_title', ['title' => $title, 'description' => $long_dse, 'short_description' => $Short_des, 'image_url' => $image, 'price' => $price], 'course_id ="' . $course_id . '"')){
    header('location: index.php');

  }
}


//=================FORM FOR ADD & EDIT CONTENT =========================\\
if (isset($_REQUEST['eidt_content'])) {
  echo 'Edit
 <div  style="padding:5%">
                <form action="" enctype="multipart/form-data" method="POST">
                <div class="card card-footer" style="padding:2%">
              Title:  <input class="form-control" type="text"  name="title" value="' . $_REQUEST['content_title'] . '">
<input class="form-control" type="text" name="video_url" hidden  value="' . $_REQUEST['content_video'] . '"><br>
Video: <input type="file" name="video"><br>
<input class="form-control" type="text" name="pdf_url" hidden  value="' . $_REQUEST['content_pdf'] . '"><br>
Pdf: <input type="file" name="pdf"><br>
About:  <textarea name="about" id="" cols="30" rows="10"  value="' . $_REQUEST['about'] . '"></textarea><br>
<button class="btn btn-success"  name="update_content" type="submit" value="'. $_REQUEST['eidt_content'].'" >Update</button>
</div></form></div>';
}else{if($_SESSION['type'] == "add") {
  echo ' Add<div  style="padding:5%">
                <form action="" enctype="multipart/form-data" method="POST">
                <div class="card card-footer" style="padding:2%">
Title: <input class="form-control" type="text" name="title" required><br>
Video:<input type="file" name="video" required><br>
Pdf: <input type="file" name="pdf"><br>
About:  <textarea name="about" id="" cols="30" rows="10"></textarea><br>

<button class="btn btn-success"  name="add_content" type="submit" >ADD</button>
</div></form></div>';
}}


//=================UPDATE CONTENT DETAILS===============================\\
if (isset($_REQUEST['update_content'])) {

  $title =  $_REQUEST['title'];
  $about = mysqli_real_escape_string($connect, $_REQUEST['about']);
  
  $video =  $_REQUEST['video_url'];
  $pdf = $_REQUEST['pdf_url'];

  $size =  $_FILES['video']['size'];
  if ($size != 0) {
    $file_tmp = $_FILES['video']['tmp_name'];
    $type = basename($_FILES['video']['type']);
    $time = time();
    $video = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../videos/" . $video);
  }

  $size =  $_FILES['pdf']['size'];
  if ($size != 0) {
    $file_tmp = $_FILES['pdf']['tmp_name'];
    $type = basename($_FILES['pdf']['type']);
    $time = time();
    $pdf = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../pdf/" . $pdf);
  }
  $update = new Database();
  $update->update('course_content', ['title' => $title, 'link' => $video, 'pdf' => $pdf, 'about'=> $about],  'course_content_id ="' . $_REQUEST['update_content'] . '"');
}

//================ADD NEW CONTENT ===============================\\
if (isset($_REQUEST['add_content'])) {
  $title =  $_REQUEST['title'];
  $about = mysqli_real_escape_string($connect, $_REQUEST['about']);

  $size =  $_FILES['video']['size'];
  if ($size != 0) {
    $file_tmp = $_FILES['video']['tmp_name'];
    $type = basename($_FILES['video']['type']);
    $time = time();
    $video = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../videos/" . $video);
  }

  $size =  $_FILES['pdf']['size'];
  if ($size != 0) {
    $file_tmp = $_FILES['pdf']['tmp_name'];
    $type = basename($_FILES['pdf']['type']);
    $time = time();
    $pdf = $time . '.' . $type;
    move_uploaded_file($file_tmp, "../../pdf/" . $pdf);
  }
  
  $add = new Database();
  $add->insert('course_content', ['title' => $title, 'link' => $video, 'pdf' => $pdf, 'about'=> $about, 'course_id' => $course_id]);
}

//================DELETE CONTENT ===============================\\
if (isset($_REQUEST['delete'])) {
$delete = new Database(); 
  $delete->delete('course_content', 'course_content_id ='. $_REQUEST['delete']);
  
}
//=================Display Type =========================\\
if ($_SESSION['type'] == "edit") {

  $all_course = new Admin;
  $where = 'course_id = ' . $course_id;
  $all_course->all_course($where);
}
 if( !isset($_REQUEST['add_course']) && $_SESSION['type'] != 'edit' ){
 $course_content = new Admin;
  $where = 'course_id = ' . $course_id;
  $course_content->course_content($where);
}

if($_SESSION['type'] != 'edit'){
  
}

ob_end_flush();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">