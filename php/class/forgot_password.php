<?php
require 'database.php';
require 'mail.php';


class Forgot{

    public $msg;
public function __construct($email){
$obj = new Database();

if($obj-> row("SELECT status FROM user WHERE email = '$email'")){
    $where = "email = '$email'";
    $obj-> select('user','password',null,$where,null,null);
  $result = $obj->getResult();
  foreach ($result as list("password"=>$password)) {
    $msg = 'Your Password is : '.$password;
     smtp_mailer($email,'Forgot password', $msg);
     session_start();  
     $_SESSION['f_msg'] = 'Password is send to <b>'.$email.'</b>';
      header("location: login.php");  
}
}else{
    $this-> msg = "Invalid email address. ".$email;
}
 
}   }
?>