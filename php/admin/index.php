<?php
ob_start();
session_start();
include '../header_footer/admin.php';
require '../class/Admin.php';
echo '<center>
    <form action="" method="POST">
        <button class="btn btn-info" type="submit" name="val" value="" id=""> All </button>
        <input class="" placeholder="Search" style=" border:none;" type="text" name="val" id="">
        <input class="btn btn-info" style="border:none;border-bottom:1px;" type="submit" name="" value="Search" id="">
    </form>
    
</center>';
//============== Search =================\\
if (isset($_REQUEST['val'])) {
    $all_course = new Admin;
    if ($_REQUEST['val'] == '') {
        echo 'Search for <b> All </b>';
    } else {
        echo 'Search for <b>' . $_REQUEST['val'] . '</b>';
    }
    $where = 'title LIKE "' . $_REQUEST['val'] . '%"';
    $all_course->all_course($where);
} else {
    $all_course = new Admin;
    $all_course->all_course(null);
}


//============== EDIT =================\\
if (isset($_REQUEST['edit'])) {
    echo $_SESSION['course_id'] = $_REQUEST['edit'];
    echo $_SESSION['type'] = 'edit';
    header('location: edit_course.php');
}

//============== ADD =================\\
if (isset($_REQUEST['add'])) {
    $_SESSION['course_id'] = $_REQUEST['add'];
    $_SESSION['type'] = 'add';
    header('location: edit_course.php');
}

//============== QUIZ =================\\
if (isset($_REQUEST['quiz'])) {
    $_SESSION['course_id'] = $_REQUEST['quiz'];
    $_SESSION['type'] = 'quiz';
    header('location: quiz.php');
}

//=================DELETE TITLE WITH  CONTENT===============================\\
if (isset($_REQUEST['delete'])) {
    $delete_title = $delete_content = new Database();
    if ($delete_title->delete('course_title', 'course_id =' . $_REQUEST['delete'])) {
        if ($delete_content->delete('course_content', 'course_id =' . $_REQUEST['delete'])) {
            header('location: index.php');
        }
    }
}

ob_end_flush();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">