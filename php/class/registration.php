<?php
require 'database.php';
require 'mail.php';
require 'otp.php';



class Registration{

    private $name, $email, $password, $re_password;
    public $msg, $otp;
   
    public function __construct($first_name, $last_name, $email, $password, $re_password)
    {
         $this-> name =   $first_name." ".$last_name;
         $this-> email = $email;
         $this-> password = $password;
         $this-> re_password = $re_password;
    }
	// Function to insert register data into the database and send otp
    public function registration(){
// check passsword 
        if($this-> password == $this->re_password){
            $row = new Database();
// check email id alreaady exist or not
            $e = "'".$this-> email."'";
            $count = $row-> row("SELECT email FROM user WHERE email = $e");
            if($count == 0){
            $insert = new Database();
// insert data to data base
         if($insert ->insert('user',['name'=>$this-> name,'email'=>$this-> email,'password'=>$this-> password,'status'=>'0'])){
            $otp = random_int(100000,999999);
            $_SESSION['otp']=$otp;
         
          $msg = 'You registered an account on <b> xyz </b>, before being able to use your account you need to verify that. <br> So, OTP is <strong>'.$otp.'</strong>';
// send email otp
        echo smtp_mailer($this-> email,'OTP', $msg);
            // $this-> otp = $otp;
            header("location: verification.php");  
                 }else{
            $this-> msg = "Somthing went Wrong Plz try again";}
        }else{
            $this-> msg = "Email address is already in use by an active user";
        }
        }else{
             $this-> msg = "Password and Confirm Password does not match";
        }
    }

    // public function email_check(){
    //     $row = new Database();
    //     $count = $row-> row("SELECT email FROM user WHERE email = 'sudhanshugolu2003@gmail.com'");
    //     if($count == 0){
    //         // $obj = new Registration();
    //         // $obj -> registration();
    //     }else{
    //         $this-> msg = "Email address is already in use by an active user";
    //     }
    
    // }

}

	// Child Class of Registration to validate OTP
class Verification extends Registration{
    public function __construct($otp_val, $email, $otp){
        $a = '"'.$email.'"';
           
    if($otp_val == $otp){
        $update = new Database();
            if($update->update('user',['status'=>'1'],'email='.$a)){
                echo  $this-> msg =" Wrong Otp";
                session_destroy();  
              header("location:login.php");  
            }        
        }else{
            $this-> e_msg =" Wrong Otp";
        }

    }
    }


class Login extends Registration{
	// Child function Registration to Login
    public function __construct($email, $password,$type){
        $obj = new Database();
            // check User is exist or not according to input email and password
        if($obj->row_num("SELECT status FROM $type WHERE email = '$email' AND password = '$password'")){
             // Check status of user is email is verified or not
            $where = "email = '$email' AND password = '$password'";
        
            $obj-> select($type,'status',null,$where,null,null);
          $result = $obj->getResult();
          foreach ($result as list("status"=>$status)) {
            if($status != 0){
                    session_start();

                    $_SESSION['email'] = $email;
                    if ($type == "admin") {
                        header("location:../admin/index.php");  
                    } else {
                        header("location:../../index.php");  
                    }
            }else{
             $this-> msg = "Please verify your email address. ".$email." ".' <a href="otp.php">click here</a>';

            }
        }
        }else{
            $this-> msg = "wrong Email or Password";
        }
         
    }
}


class Otp{
	//Function to Send otp to email when Email id verified or Not Verified

    public function __construct($email){
       
            $otp = random_int(100000,999999);
            $_SESSION['otp']=$otp;
            echo smtp_mailer($email,'OTP',$otp);
            // $this-> otp = $otp;
            header("location:verification.php");  
        
    
    }
}






?>