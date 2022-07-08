<?php
require '../class/registration.php';

session_start();


if (isset($_SESSION['email'])) {
	header('location: ../../index.php');
} else {
	include '../header_footer/not_login.php';
}
$_SESSION['email_verification'] = 1;

$msg = '';
if (isset($_SESSION['f_msg'])) {
	$msg = $_SESSION['f_msg'];
	session_destroy();
}
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$type = $_POST['type'];
	$_SESSION['reg_email'] = $email;
	$password = $_POST['password'];
	$log = new Login($email, $password,$type);
	$msg = $log->msg;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

	<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
	<link href="css/index.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
</head>

<body>
	<div class="container" style="padding-top: 7%;padding-left: 17%;padding-bottom: 10%; ">
		<div class="row">
			<div style="width: 75%;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Log In <small></small></h3>
					</div>
					<div class="panel-body">
						<form role="form" method="post">
							<div class="row">
								<select name="type" class="form-control input-sm" id="">
									<option value="user">Student</option>
									<option value="admin">Admin</option>
								</select> <br><br>
								<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required="required"><br> <br>

								<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required="required"><br> <br>


								<input type="submit" name="login" value="Login" class="btn btn-info btn-block">

						</form>
						<center>
							<div>
								<p>forgot your password? <a href="forgot_password.php">click here</a>
								</p>
								<div>
									new user? <a href="registration.php">create new account</a>
								</div>
								<div style="color: red;">
									<?php echo $msg; ?>
								</div>
							</div>
						</center>

					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</body>

</html>

<?php include '../header_footer/footer.php'; ?>