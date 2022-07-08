<?php
require '../class/forgot_password.php';
$msg = '';

require '../header_footer/not_login.php';
session_start();
if (isset($_POST['email_but'])) {

	$email = $_POST['email'];

	$obj = new Forgot($email);
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
	<title>Forgot Password</title>
</head>

<body>

	<div class="container" style="padding-top: 12%;padding-left: 17%;padding-bottom: 12%; ">
		<div class="row ">
			<div style="width: 75%;" class="card">
				<div style="padding: 2%;">
					<div class="panel-heading">
						<h3 class="panel-title">Forgot Password <small></small></h3>
					</div>
					<div class="panel-body">
						<form role="form" method="post">
							<div class="row">


								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required="required">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="submit" name="email_but" class="btn btn-info btn-block" value="Verify">
									</div>

								</div>
						</form>
						<center>
							<div>
								<div style="color: red;">
									<h5><?php echo $msg; ?> </h5>

								</div>
								<!-- <p>already have an account?<a href="login.php">login here</a> </p> -->
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

<?php require '../header_footer/footer.php'; ?>