<?php

session_start();
include '../header_footer/admin.php';
include '../class/quiz.php';

require '../class/Admin.php';
if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
} else {
    header('location: admin.php');
}


//============== QUIZ FORM =================\\
if (isset($_REQUEST['edit'])) {
    echo '
<div class="card" style="padding:2%">
    <h4>Edit Question</h4>
    <form method="post">
        <textarea class="form-control" name="question" id="" cols="30" rows="10" placeholder="Type Question " required>' . $_REQUEST['question'] . '</textarea> <br>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="a" required>
                </div>
            </div>
            <input class="form-control" type="text" name="a" placeholder="Option A" value="' . $_REQUEST['a'] . '" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="b" required>
                </div>
            </div>
            <input class="form-control" type="text" name="b" placeholder="Option B" value="' . $_REQUEST['b'] . '" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="c" required>
                </div>
            </div>
            <input class="form-control" type="text" name="c" placeholder="Option C" value="' . $_REQUEST['d'] . '" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="d" required>
                </div>
            </div>
            <input class="form-control" type="text" name="d" placeholder="Option D" value="' . $_REQUEST['d'] . '" required><br>
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit" name="edit_question" value="'. $_REQUEST['edit'].'">Edit Question</button>

        </form>
        </div>
        <body class= "card-footer"></body>
';
} else {

    echo '
<div class="card" style="padding:2%">
        <h4>Add Question</h4>
    <form method="post">
        <textarea class="form-control" name="question" id="" cols="30" rows="10" placeholder="Type Question " required></textarea> <br>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="a" required>
                </div>
            </div>
            <input class="form-control" type="text" name="a" placeholder="Option A" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="b" required>
                </div>
            </div>
            <input class="form-control" type="text" name="b" placeholder="Option B" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="c" required>
                </div>
            </div>
            <input class="form-control" type="text" name="c" placeholder="Option C" required><br>
        </div>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" name="ans" value="d" required>
                </div>
            </div>
            <input class="form-control" type="text" name="d" placeholder="Option D" required><br>
        </div>

        <button class="btn btn-primary btn-lg btn-block" type="submit" name="add">Add Question</button>

        </form>
        </div>
        <body class= "card-footer"></body>
';
}
//================ ADD NEW QUESTION ===============================\\
if (isset($_REQUEST['add'])) {
    $add = new Database();
    $question = $_REQUEST['question'];
    $ans = $_REQUEST['ans'];
    $a = $_REQUEST['a'];
    $b = $_REQUEST['b'];
    $c = $_REQUEST['c'];
    $d = $_REQUEST['d'];

    $add->insert('quiz', ["question" => $question, "opt_A" => $a, "opt_B" => $b, "opt_C" => $c, "opt_D" => $d, "ans" => $ans, 'course_id' => $course_id]);
}
//================= EDIT QUESTION ===============================\\
if (isset($_REQUEST['edit_question'])) {
    $update = new Database();
    $question = $_REQUEST['question'];
    $ans = $_REQUEST['ans'];
    $a = $_REQUEST['a'];
    $b = $_REQUEST['b'];
    $c = $_REQUEST['c'];
    $d = $_REQUEST['d'];

    $update->update('quiz', ["question" => $question, "opt_A" => $a, "opt_B" => $b, "opt_C" => $c, "opt_D" => $d, "ans" => $ans],  'quiz_id ="' . $_REQUEST['edit_question'] . '"');
}
//============== DELETE QUIZ QUESTION =================\\
if (isset($_REQUEST['delete'])) {
    $delete = new Database();
    $delete->delete('quiz', 'quiz_id =' . $_REQUEST['delete']);
}
//============== QUIZ Questions =================\\
$obj = new Quiz;
$obj->question($course_id, 'admin');
