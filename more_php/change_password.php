<?php
/*
	Used at the change password site. Uses PHPMailer to help us send the e-mail.
*/
require("PHPMailer-master/PHPMailerAutoload.php");

$errorMsg = "";
$returnError = false;

if (!isset($_POST['username'])||!isset($_POST['oldpass'])||!isset($_POST['newpass'])){
	$returnError = true;
};

if (!empty($_POST)) {
	if (empty($_POST['username'])||empty($_POST['oldpass'])||empty($_POST['newpass'])) {
		$errorMsg = "Please fill out all forms before submitting.";
		$returnError = true;
    };
};

if(!$returnError){
	require("db_connect_realmd.php");
	
	$username=$_POST['username'];
	$username=strtoupper($username);
	//Check if the account name exists or not
	$qry = $dbh->prepare("SELECT username FROM account WHERE username = :uname");
	$qry->bindParam(':uname', $username, PDO::PARAM_STR, 16);
	$qry->execute();
	$name = $qry->fetchColumn();
	
	if ($name=="") {
		$errorMsg = "Account name doesn't exists. Try another one!";
		$returnError = true;
		unset($qry);
	}
	if(!$returnError){
		$qry2 = $dbh->prepare("SELECT sha_pass_hash FROM account WHERE username = '$name'");
		$qry2->execute();
		$originalPass = $qry2->fetchColumn();
		
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=6Lc4Nf4SAAAAAEC1jwxG1ZDr--ap1xVt6RAXFjQa&response=";
		$json = file_get_contents($url.$_POST['g-recaptcha-response']);
		$obj = json_decode($json);
		
		if(sha1($name.":".strtoupper($_POST['oldpass'])) != $originalPass){
			$returnError = true;
			$errorMsg = "The old password is wrong.";
		}else if(!$obj->{'success'}){
			$errorMsg = "Captcha not validated.";
			$returnError = true;
		}else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['newpass'])){
			$errorMsg = "Only a-z, 0-9 is allowed in your password.";
			$returnError = true; 
		}else if($_POST['newpass']!=$_POST['renewpass']){
			$errorMsg = "The passwords do not match.";
			$returnError = true;
		}else if(strlen($_POST['newpass']) > 16|| strlen($_POST['newpass']) < 5){
			$errorMsg = "Your password must be at least 5 characters long, 
			and a maximum of 16 characters long.";
			$returnError = true;
		}
	}
	
	if(!$returnError){
		$pass = sha1($name.":".strtoupper($_POST['newpass']));
		$stmt = $dbh->prepare("UPDATE account SET sha_pass_hash = '$pass' WHERE username = '$name'");
		$stmt->execute();
	}
}
?>