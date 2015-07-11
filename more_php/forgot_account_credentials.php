<?php
/*
	Send back an users account name and a new password to the e-mail address they submitted during registration.
*/
require("PHPMailer-master/PHPMailerAutoload.php");

$errorMsg = "";
$returnError = false;

if (!isset($_POST['to'])){
	$returnError = true;
};

if (!empty($_POST)) {
	if (empty($_POST['to'])) {
		$errorMsg = "Please fill out all forms before submitting.";
		$returnError = true;
    };
};

if(!$returnError){
	require("db_connect_realmd.php");
	
	$email=$_POST['to'];
	//Check if the email exists or not
	$qry = $dbh->prepare("SELECT email FROM account WHERE email = :email");
	$qry->bindParam(':email', $email, PDO::PARAM_STR);
	$qry->execute();
	$tomail = $qry->fetchColumn();
	if ($tomail=="") {
		$errorMsg = "E-mail doesn't exists.";
		$returnError = true;
		unset($qry);
	}
	if(!$returnError){
		$qry = $dbh->prepare("SELECT username FROM account WHERE email = :email");
		$qry->bindParam(':email', $email, PDO::PARAM_STR);
		$qry->execute();
		$username = $qry->fetchColumn();
		
		$rnd = mt_rand(10000002, 21474836);
		$characters = 'abcdefghijklmnopqrstuvwxyz';
		$randomString = '';
		for ($i = 0; $i < 6; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		$superpass = str_shuffle($rnd.$randomString);
		$pass = sha1($username.":".$superpass);
		$stmt = $dbh->prepare("UPDATE account SET sha_pass_hash = '$pass' WHERE username = '$username'");
		$stmt->execute();
		
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=6Lc4Nf4SAAAAAEC1jwxG1ZDr--ap1xVt6RAXFjQa&response=";
		$json = file_get_contents($url.$_POST['g-recaptcha-response']);
		$obj = json_decode($json);
		if(!$obj->{'success'}){
			$errorMsg = "Captcha not validated.";
			$returnError = true;
		}
	}
}
if(!$returnError){
    $mail = new PHPMailer(true);
	//Send mail using gmail
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = "ssl"; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; 
	$mail->Username = "xxx@mail.com"; 
	$mail->Password = "xxx"; //CHANGED PASSWORD

	$mail->AddAddress($tomail, "User");
	$mail->SetFrom('xxx@mail.com', 'AdminName');
	$mail->Subject = "SUBJECT";
	$mail->Body = "Account name: ".$username."<br>New password: ".$superpass;
	$mail->IsHTML (true);
	try{
		$mail->Send();
		$errorMsg = "Success! Your account name and a new password has been sent to the e-mail. Remember that you can change the new password on this site.";
	} catch(Exception $e){
		$errorMsg = "Failure sending password.";
		echo "Fail - " . $mail->ErrorInfo;
	}
}
?>