<!DOCTYPE html>
<?php
/*
	Visual for the register account page. This reefers to game accounts.
*/
require("more_php/check_tos.php");
require("more_php/register_page.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>

<div class="content">
<p> The e-mail field is optional and only used for restoring account credentials. </p><br>
<form method="post" action="register">
	Account name:<br>
	<input type="text" name="username">
	<br><br>
	Password:<br>
	<input type="password" name="password">
	<br><br>
	Repeat password:<br>
	<input type="password" name="repassword">
	<br><br>
	E-mail:<br>
	<input type="text" name="email">
	<br><br>
	<div class="g-recaptcha" data-sitekey="xxx"></div>
	<br><br>
	<input type="submit" value="Submit">
</form>
<?php if($returnError) : ?>
	<br><br>
	<p class="errorMsg"><?php echo "$errorMsg";?></p>
<?php else: ?>
	<img src="\images\wowchibi.gif">
<?php endif; ?>
</div>

</body>
</div>

<?php include 'footer.html'; ?>

</html>
