<!DOCTYPE html>
<?php
/*
	Visual for the password changing page.
*/
require("more_php/check_tos.php");
require("more_php/change_password.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
<link rel="stylesheet" type="text/css" href="wowcss/change_password.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>
			
<div class="content">
	<form method="POST" action="changepass">
	Account name:<br>
	<input type="text" name="username">
	<br><br>
	Old password:<br>
	<input type="password" name="oldpass">
	<br><br>
	New password:<br>
	<input type="password" name="newpass">
	<br><br>
	Repeat new password:<br>
	<input type="password" name="renewpass">
	<br><br>
	<div class="g-recaptcha" data-sitekey="xxx"></div>
	<br><br>
	<input type="submit" value="Submit">
	</form>
	<br><br>
	<?php if($returnError):?>
		<p class = "errorMsg"><?php echo $errorMsg; ?></p>
	<?php else: ?>
		<img src="\images\wowchibi.gif">
	<?php endif; ?>
</div>
</body>
</div>
<?php include 'footer.html'; ?>

</html>
