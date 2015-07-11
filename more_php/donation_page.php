<?php
/*
	Our functionality at the Donation page. Currently uses Paymentwall, which will call our pingback.php page at a 
	succesfull donation. It has only been tested to work at sandbox level and will currently only display 
	properly if the key used is updated.
*/
$errorMsg;
$returnError = false;
$charname;
if ( !isset($_POST['charname']))
{
	$errorMsg = "";
	$returnError = true;
};

if (!empty($_POST)) {
if ((empty($_POST["charname"]))) {
		$errorMsg = "Form: F-fill me first, s-senpai..! *o*";
		$returnError = true;
    };
};

if(!$returnError){
	require("db_connect_characters.php");
	
	$charname=$_POST['charname'];
	$charname = ucwords($charname);
	//Check if the characters name exists or not
	$qry = $dbh->prepare("SELECT name FROM characters WHERE name = :name");
	$qry->execute(array('name' => $charname));
	$name = $qry->fetchColumn();

	if ($name=="") {
		//Char name didn't exist
		$errorMsg = "I-I'm sorry senpai, but... but the character name doesn't exist!! ;_;";
		$returnError = true;
		unset($qry);
	};
}
if(!$returnError){

	$fetchracegender = $dbh->query('SELECT gender, race, class FROM characters WHERE name = "'.$name.'"');
	$raceinteger = $fetchracegender->fetch();
	$rgimage = returnrace($raceinteger[0], $raceinteger[1]);
	$cimage = returnclass($raceinteger[2]);
	
	// Paymentwall PHP Library: https://www.paymentwall.com/lib/php
	require_once('paymentwall-php-master\lib\paymentwall.php');
	Paymentwall_Base::setApiType(Paymentwall_Base::API_GOODS);
	Paymentwall_Base::setAppKey('xxx'); 
	Paymentwall_Base::setSecretKey('xxx');

	$widget = new Paymentwall_Widget(
		$name,
		'p1_1',
		array(
			new Paymentwall_Product(
				'19364',                           
				9.99,                                   
				'USD',                                  
				'Ashkandi',                      
				Paymentwall_Product::TYPE_FIXED
			)
		),
		array('email' => 'user@hostname.com')
	);
}
?>