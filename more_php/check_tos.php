<?php
/*
	Forces our user to accept the ToS before visiting any of our pages. Used on every page.
*/
if(!isset($_COOKIE["readRules"])) {
	header("Location: tos");
	exit;
}
?>