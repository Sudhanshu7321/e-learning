<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
require '../../class/mail.php';
// require '../../class/database.php';


// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require '../../class/course.php';
//======================================================\\
session_start();

//  echo       $email = $_SESSION['email'] = $_COOKIE['email_id'];
// echo      $course_id = $_COOKIE['course_id'];
// echo      $user_id = $_COOKIE['user_id'];

// // $email = $_SESSION['email'] = $_COOKIE['email_id'];
// $course_id = $_COOKIE['course_id'];

// $user_details = new Course();
// $user_details->user_details($email);
// $user_name =  $user_details->user_name;
// $user_id =  $user_details->user_id;

//======================================================\\

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if ($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";

	if ($_POST["STATUS"] == "TXN_SUCCESS") {

		//Process your transaction here as success transaction.


		if (isset($_POST) && count($_POST) > 0) {
			$html = '';

			foreach ($_POST as $paramName => $paramValue) {
				$html .=	 "<br/>" . $paramName . " = " . $paramValue . '<br>';
				if ($paramName == 'ORDERID') {
					echo $order_id = $paramValue;
				}
			}
		}

		$one = 1;
		$obj = new Database();
		if($obj->update('purchase', ['status' => $one . ''], 'order_id="' . $order_id . '"')){
			$column = '*';
			$where = 'order_id = ' . $order_id . '';
			$join = "user ON user.id = purchase.user_id";
			$obj->select('purchase', $column, $join, $where, null, null);
			$result = $obj->getResult();
			foreach ($result as list("email" => $email)) {
				$_SESSION['email'] = $email;
			}
			smtp_mailer($email, 'Invoice', $html);
			
			header("location:../../pages/my_course.php");
		}
		

		// $insert = new  Database();
		// if ($insert->insert('purchase', ['user_id' => $user_id, 'course_id' => $course_id, 'order_id' => $order_id])) {

		// }

		// echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {
		echo '<script>alert("Transaction status is failure")</script>';

		header("location:../../pages/learn_course.php");

		// echo "<b>Transaction status is failure</b>" . "<br/>";
	}


	if (isset($_POST) && count($_POST) > 0) {
		foreach ($_POST as $paramName => $paramValue) {
			echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
} else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.


}
