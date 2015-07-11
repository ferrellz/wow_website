<!DOCTYPE html>
<?php
/*
	The visual for the Donation page. Uses the same autocomplete as the armory does.
	Includes 'honorable_kills_functions.php' because it will use the two functions in it. Which makes the name
	kinda silly.
*/
require("more_php/check_tos.php");
require("more_php/honorable_kills_functions.php");
require("more_php/donation_page.php");
?>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
<link rel="stylesheet" type="text/css" href="wowcss/donation_page.css">
</head>
<script>
$(function() {
	$( "#tags" ).autocomplete(
	{
		 source:'more_php/autocomplete.php',
		 minLength: 3,
		 delay: 1000
	})
});
</script>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>

<div class="ui-widget">
	<form method="post" action="donate">
		<label for="tags">Character Name: </label>
		<input maxlength="12" id="tags" name="charname" type ="text" >
		<input name="Submit" type="submit" value="Search!" />
	</form>
</div>

<div class="content">
<?php if(!$returnError) : ?>
	<p class="charname"><?php echo $name;?></p><p><?php echo $rgimage;?><?php echo $cimage;?></p><br><br><br>
	<?php echo $widget->getHtmlCode(); ?>
<?php else : ?>
	<p class="errorMsg"><?php echo "$errorMsg";?></p>
<?php endif; ?>
</div>

</body>
</div>

<?php include 'footer.html'; ?>

</html>	