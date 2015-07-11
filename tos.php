<!DOCTYPE html>
<?php
/*
	The terms of service and rules as assumed we would offer an option for donation that rewards you 
	with cosmetic in-game items. We check if the user have agreed to the ToS before we allow them to 
	visit any other pages than this one.
*/
	if(isset($_POST['accept']))
	{
		setcookie("readRules", "true", time() + (86400 * 30), "/");
		header("Location: index");
		exit;
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
</head>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>
	
<div class="content">
<div class="scrollBox">
<h1>Terms of Service and General Rules</h1>
<br><br>
<p align="left">
Rules goes here!
</p><br>
<h2 align="left">Cookies</h2>
<br>
<p align="left">
This site uses cookies.
</p>
<br><br>
</div>
<br><br>
<form action="tos" method="POST">
<input type="checkbox" name="accept">I HAVE READ AND UNDERSTAND THIS AGREEMENT, AND I ACCEPT AND AGREE TO ALL OF ITS TERMS AND CONDITIONS.
<br><br>
<input type="submit" value="Accept">
</form> 

</div>
</body>
</div>
<?php include 'footer.html'; ?>

</html>
