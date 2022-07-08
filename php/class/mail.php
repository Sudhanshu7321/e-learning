<?php
include('smtp/PHPMailerAutoload.php');
$html = 'Msg';

// echo smtp_mailer('sudhanshugolu2003@gmail.com','subject',$html);

function smtp_mailer($to, $subject, $msg)
{
	$mail = new PHPMailer();
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "g262412k@gmail.com";
	$mail->Password = "18533golu";
	$mail->SetFrom("g262412k@gmail.com", 'Sudhanshu');
	$mail->Subject = $subject;
	$mail->addReplyTo('example@example.com', 'EXAMPLE');
	$mail->Body = $msg;
	$mail->AddAddress($to);
	// $mail->addAttachment("demo.php");
	$mail->SMTPOptions = array('ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => false
	));
	if (!$mail->Send()) {
		echo $mail->ErrorInfo;
	} else {
		return true;
	}
}
