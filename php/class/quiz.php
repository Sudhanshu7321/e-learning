<?php
class Quiz
{

  function question($course_id, $type)
  {
    $q_no = 1;
    $questions = new Database();
    $questions->select('quiz', '*', null, 'course_id = ' . $course_id, null, null);
    $result = $questions->getResult();
    echo '<div  style="margin:7%;">';
    foreach ($result as list("quiz_id" => $quiz_id, "question" => $question, "opt_A" => $a, "opt_B" => $b, "opt_C" => $c, "opt_D" => $d, "ans" => $ans)) {

      if ($type == 'admin') {
        echo '<div class= "card" style="padding:1%;margin:2%">';
        echo $q_no . '.  ' . $question . '<br>';
        echo 'A)  ' . $a.'<br>';
        echo 'B)  ' . $b . '<br>';
        echo 'C)  ' . $c . '<br>';
        echo 'D)  ' . $d . '';

        echo ' <form method="POST">
    <h5 class="text-success">Option ' . $ans . ' right Answre.</h5>

    <input type="text" hidden name="question" value="' . $question . '">
    <input type="text" hidden name="a" value="' . $a . '">
    <input type="text" hidden name="b" value="' . $b . '">
    <input type="text" hidden name="c" value="' . $c . '">
    <input type="text" hidden name="d" value="' . $d . '">
    <button class="btn btn-primary" name="edit" type="submit" value="' . $quiz_id . '">Edit</button>
    <button class="btn btn-danger" name="delete" type="submit" value="' . $quiz_id . '">Delete</button>
</form>';

        echo '</div><body  class= "card-footer" ></body>';
        $q_no += 1;

      } else {


        echo '<div class= "card" style="padding:2%">
          <form  method="post" >
<h5>' . $q_no . ' ' . $question . '</h5>
<h5><input type="radio" name="' . $q_no . '" value="a">' . ' ' . $a . '</h5>
<h5><input type="radio" name="' . $q_no . '" value="b">' . ' ' . $b . '</h5>
<h5><input type="radio" name="' . $q_no . '" value="c">' . ' ' . $c . '</h5>
<h5><input type="radio" name="' . $q_no . '" value="d">' . ' ' . $d . '</h5>';
        echo '</div><br>';
        $q_no += 1;

        echo '  <button type="submit" name="result" >Submit</button>
    </form>';
        echo '</div><body  class= "card-footer" ></body>';
      }
    }
  }

  function score($course_id, $user_id)
  {
    $q_no = 1;
    $r_ans = 0;
    $w_ans = 0;

    $score = new Database();
    $score->select('quiz', 'ans', null, 'course_id =' . $course_id, null, null);
    $result = $score->getResult();
    foreach ($result as list("ans" => $ans)) {
      if ($_REQUEST[$q_no] == $ans) {
        $r_ans += 1;
      } else {
        $w_ans += 1;
      }
      $q_no += 1;
    }
    $count = $score->row_num("SELECT * FROM quiz_score WHERE   course_id = $course_id And user_id = $user_id");
    if ($count != 1) {
      $score->insert('quiz_score', ['w_question' => $w_ans, 'r_question' => $r_ans, 'course_id' => $course_id, 'user_id' => $user_id, 'attempts' => '1']);
      header('location: ../pages/my_course.php');
    } else {
      $score->update('quiz_score', ['w_question' => $w_ans, 'r_question' => $r_ans, 'attempts' => '2'], 'course_id ="' . $course_id . '" And user_id ="' . $user_id . '"');
      header('location: ../pages/my_course.php');
    }
  }
}
