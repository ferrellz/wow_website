<!DOCTYPE html>
<?php
/*
	Very simple visual to vote for us at private server websites. The link needs to be corrected when/if the server comes
	up live, so it actually takes us to voting for us.
	Won't put much more work into this page though, since it's easy to circumvent voting systems with rewards by clicking
	the link (you get the reward at this point) and then not actually voting (at the site you were redirected to).
*/
	require("more_php/check_tos.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
</head>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>	

<div class="content">
<h1>Vote for us minions, you will not be rewarded!</h1>

<a href="http://www.openwow.com/vote=3177" target="_blank">openwow</a>
<a href="http://www.xtremetop100.com/in.php?site=1132296123" target="_blank">xtremetop100</a>

</div>
</body>
</div>
<?php include 'footer.html'; ?>

</html>
