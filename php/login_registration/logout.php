 <?php  
 //logout.php  
 session_start();  
 session_destroy();  
 header("location:https://localhost/course/index.php");  
 ?>  