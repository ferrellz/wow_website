<?php
/*
	The functionality behind the register account page.
	Nothing special, just makes sure that the account name and password uses a form that the game client allows.
	Allows the user to register without an e-mail submitted, since the e-mail is only used for forgotten credentials.
	Their loss. :^) 
*/
$errorMsg;
$returnError = false;

if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['repassword'])){
	$errorMsg = "";
	$returnError = true;
};

if (!empty($_POST)) {
	if ((empty($_POST['username']))||(empty($_POST["password"]))||(empty($_POST["repassword"]))) {
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
	
	$email=$_POST['email'];
	//Check if the email exists or not
	$qry = $dbh->prepare("SELECT email FROM account WHERE email = :email");
	$qry->bindParam(':email', $email, PDO::PARAM_STR);
	$qry->execute();
	$mail = $qry->fetchColumn();
	
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=6Lc4Nf4SAAAAAEC1jwxG1ZDr--ap1xVt6RAXFjQa&response=";
	$json = file_get_contents($url.$_POST['g-recaptcha-response']);
	$obj = json_decode($json);
	
	if (!$name=="") {
		$errorMsg = "Account name already exists. Try another one!";
		$returnError = true;
	}else if (!$mail=="") {
		$errorMsg = "E-mail already exists. Try another one!";
		$returnError = true;
	}else if(!$obj->{'success'}){
		$errorMsg = "Captcha not validated.";
		$returnError = true;
	}else if($_POST['password']!=$_POST['repassword']){
		$errorMsg = "The passwords do not match.";
		$returnError = true;
	}else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])||!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])){
		$errorMsg = "Only a-z, 0-9 is allowed in your account name and password.";
		$returnError = true; 
	}else if(strlen($_POST['username']) > 16|| strlen($_POST['username']) < 5 || strlen($_POST['password']) > 16|| strlen($_POST['password']) < 5){
		$errorMsg = "Your password and account name must be at least 5 characters long, 
		and a maximum of 16 characters long.";
		$returnError = true;
	}
	
	if(!$returnError){
		$stmt = $dbh->prepare("INSERT INTO account (username, sha_pass_hash, email) VALUES (:name, :pass, :mail)");
		$stmt->bindParam(':name', $_POST['username'], PDO::PARAM_STR);
		$stmt->bindParam(':pass', sha1($_POST['username'].":".strtoupper($_POST['password'])),PDO::PARAM_STR);
		$stmt->bindParam(':mail', $_POST['email'], PDO::PARAM_STR);
		$stmt->execute();
	}
	$dbh = null;
}
?>