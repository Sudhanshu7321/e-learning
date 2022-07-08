<?php
session_start();
ob_start();

if (isset($_SESSION['email'])) {
	header('location: ../../index.php');
} else {
	include '../header_footer/not_login.php';
}
require  '../class/registration.php';
$msg = '';
if (isset($_POST['register'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = $_POST['password'];
	$re_password = $_POST['password_confirmation'];
	$email = $_POST['email'];
	$_SESSION['reg_email'] = $email;
	$obj = new Registration($first_name, $last_name, $email, $password, $re_password);
	$obj->registration();
	$msg = $obj->msg;
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
		<div class="row ">
			<div style="width: 75%;" class="card">
				<div style="padding: 2%;">
					<div class="panel-heading">
						<h3 class="panel-title">Registration <small></small></h3>
					</div>
					<div class="panel-body">
						<form role="form" method="post">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" required="required">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" required="required">
									</div>
								</div>
							</div>

							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required="required">
							</div>

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required="required">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required="required">
									</div>
								</div>
							</div>

							<input type="submit" value="Register" name="register" class="btn btn-info btn-block">

						</form>
						<center>
							<div>
								<p>already have an account?<a href="login.php">login here</a> </p>
							</div>
							<div style="color: red;">
								<p class="body"><?php echo $msg ?></p>
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