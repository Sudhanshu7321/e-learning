<?php
require '../class/registration.php';
session_start();  
$email = $_SESSION['email'];
$obj1 = new Otp($email);
?>