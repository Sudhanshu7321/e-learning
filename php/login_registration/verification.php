<?php require '../class/registration.php';
session_start();

if (isset($_SESSION['email'])) {
	header('location: ../../index.php');
} else {
	include '../header_footer/not_login.php';
}

if (isset($_SESSION['reg_email'])) {

	$email = $_SESSION['reg_email'];
	echo $otp = $_SESSION['otp'];
	$e_msg = '';
	$msg = '<div ><table class="text-success"><tr><td>Please go to your registered email address <b>' . $email . '</td></tr><tr><td> copy OTP to complete Registration. </td></tr>
<tr><td>Email arrived between 2 to 4 Minutes.</td></tr>
<tr><td>Also Check Spam Box.</td></tr></table></div>';
	if (isset($_POST['otp'])) {
		$otp_val = $_POST['otp_val'];
		$obj = new Verification($otp_val, $email, $otp);
		$e_msg = $obj->e_msg;
	}
} else {
	header("location:login.php");
}

?>
<html lang="en">

<head>
	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
	<link href="css/index.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verification</title>
</head>

<body>

	<table>
		<tr>
			<td></td>
		</tr>
	</table>
	<div class="container" style="padding-top: 7%;padding-left: 17%;padding-bottom: 10%; ">
		<div class="row ">
			<div style="width: 75%;" class="card">
				<div style="padding: 2%;">
					<div class="panel-heading">
						<h3 class="panel-title">Email Verification <small></small></h3> <br>
					</div>
					<div class="panel-body">
						<form role="form" method="post">
							<div class="form-group"><input type="password" name="otp_val" id="password" class="form-control input-sm" placeholder="Enter 6-digit otp" required="required"></div>
							<div class="form-group"><input type="submit" name="otp" class="btn btn-info btn-block" value="Verify"></div>
					</div>
					</form>
					<center>
						<div>
							<div style="color:red;">
								<h4><?php echo $e_msg;
									?></h4>
							</div>
							<div style="color: green;">
								<h4><?php
									echo $msg;
									?></h4>
							</div>

							<p>already have an account?<a href="login.php">login here</a></p>
						</div>
					</center>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>
<?php include '../header_footer/footer.php'; ?>