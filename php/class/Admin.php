<?php
require 'database.php';

class Admin
{

    function __construct()
    {
    }

    function course_content($where)
    {
        $obj = new Database();
        $obj->select('course_content', '*', null, $where, null, null);
        $result = $obj->getResult();
        echo  '<table class="table">
          <thead>
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Title</th>
      <th scope="col">Video</th>
        <th scope="col">Pdf</th>    
        <th scope="col">About</th>
      <th scope="col">Edit</th>
            <th scope="col">Delete</th>

    </tr>
  </thead>';
        $sn = 0;
        foreach ($result as list("title" => $title, "link" => $link, "course_content_id" => $content_id, 'pdf' => $content_pdf, 'about' => $about)) {
            $sn += 1;
            echo '
            <tr>
      <th scope="row">' . $sn . '</th>
      <td>' . $title . '</td>
      <td> <a  href="../../videos/' . $link . ' " target="_blank">Watch Video</a></td>
                <td> <a  href="../../pdf/' . $content_pdf . ' " target="_blank">View Pdf</a></td>
      <td>' . $about . '</td>

     </td>
      <td>
      <form method="POST">
           <input type="text" name="content_title" hidden  value="' . $title . '">
           <input type="text" name="content_video" hidden  value="' . $link . '">
                      <input type="text" name="content_pdf" hidden  value="' . $content_pdf . '">
                      <input type="text" name="about" hidden  value="' . $about . '">
            <button class="btn btn-primary" name="eidt_content" type="submit" value="' . $content_id . '">Edit</button>
      </form>
</td>
    <td>
     <form method="POST">
     <button class="btn btn-danger"  name="delete" type="submit" value="' . $content_id . '">Delete</button>
           </form>

</td>

    </tr>';
        }
        echo '  </thead>';
    }

    function all_course($where)
    {
        $obj = new Database();
        $obj->select('course_title', '*', null, $where, null, null);
        $result = $obj->getResult();
        foreach ($result as list("course_id" => $course_id, "title" => $title, "short_description" => $short_des, 'image_url' => $url, 'price' => $price, 'description' => $long_des)) {
            $page = basename($_SERVER['PHP_SELF']);

            if ($page != 'edit_course.php') {

                echo '<br><center>
    <div class="card" style="width: 80%;">
        <div style="padding: 3%;">
            <div class="card-footer">
                <img width="35%" height="200px" style="float: right;padding-left:1.5%" src="../../images/' . $url . '" alt="">
            <table>   
            <tr> 
               <td>
                   <h3>' . $title . ' </h3> 
            </td>   
             <td>    
                   <h5>
                  ( Price RS.' . $price . ')
                   </td>  
                    </tr>
           </table>
                <p>' . $short_des
                    . '</p>
            </div>
            <div style="padding-top:1%">
           <form method="POST">
                    <button class="btn btn-success"  name="add" type="submit" value="' . $course_id . '">Add Content</button>
                    <button class="btn btn-primary" name="edit" type="submit" value="' . $course_id . '">Edit</button>
                    <button class="btn btn-success"  name="quiz" type="submit" value="' . $course_id . '">Quiz</button>
                    <button class="btn btn-danger"  name="delete" type="submit" value="' . $course_id . '">Delete</button>
            </form>
            </div>
        </div>
</center>';
            } else {
                echo '                <div  style="padding:5%">
                <form action="" enctype="multipart/form-data" method="POST">
                <div class="card card-footer" style="padding:2%">
Title: <input class="form-control" type="text" name="title" value="' . $title . '"> <br>
Price: <input class="form-control" type="text" name="price" value="' . $price . '"> <br>
<input class="form-control" type="text" name="image_url" hidden  value="' . $url . '"> 
Image:<input  type="file" name="image"> <br>
Short Description: <textarea class="form-control" name="Short_des" id="" cols="30" rows="10">' . $short_des . '</textarea><br>
Long Description:<textarea class="form-control" name="long_des" id="" cols="30" rows="10">' . $long_des . '</textarea> <br>
<button class="btn btn-success"  name="update" type="submit" >Update</button>

</div></form></div>';
            }
        }
    }
}
