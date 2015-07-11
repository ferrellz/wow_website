<!DOCTYPE html>
<?php
/*
	The visual behind our Forgot Credentials page.
*/
require("more_php/check_tos.php");
require("more_php/forgot_account_credentials.php");
?>
<html>
<head>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
</head>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>	
	
<div class="content">
	<form method="POST" action="forgotacc">
	E-mail:<br>
	<input type="text" name="to">
	<br><br>
	<div class="g-recaptcha" data-sitekey="xxx"></div>
	<br><br>
	<input type="submit" value="Submit">
	</form>
	<br><br>
	<?php if($returnError):?>
		<p class ="errorMsg"><?php echo $errorMsg;?></p>
	<?php else: ?>
		<img src="\images\wowchibi.gif">
	<?php endif;?>
	<br><br>
</div>
</body>
</div>
<?php include 'footer.html'; ?>

</html>
