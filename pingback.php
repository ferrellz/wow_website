<?php
/*
	The pingback which Paymentwall will call on a successful donation.
	Insert the reward item in the mail_external table to mail the item to
	the character in-game.
*/
require_once('paymentwall-php-master\lib\paymentwall.php');
Paymentwall_Base::setApiType(Paymentwall_Base::API_GOODS);
Paymentwall_Base::setAppKey('xxx'); 
Paymentwall_Base::setSecretKey('xxx');

$pingback = new Paymentwall_Pingback($_GET, $_SERVER['REMOTE_ADDR']);
if ($pingback->validate()) {
	$productId = $pingback->getProductId();
	$userId = $pingback->getUserId();
	$refId = $pingback->getReferenceId();
	$message = "Message";
	$subject = "Subject";
	
	require("more_php/db_connect_characters.php");
	
	if ($pingback->isDeliverable()) {
		$qry = $dbh->prepare("SELECT guid FROM characters WHERE name = :pname");
		$qry->bindParam(':pname', $userId, PDO::PARAM_STR, 16);
		$qry->execute();
		$guid = $qry->fetchColumn();
		
		$stmt = $dbh->prepare("INSERT INTO mail_external (receiver, subject, message, item, item_count) VALUES (:guid, :subject, :message, :item, 1)");
		$stmt->bindParam(':guid', $guid, PDO::PARAM_INT);
		$stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
		$stmt->bindParam(':message', $message, PDO::PARAM_STR);
		$stmt->bindParam(':item', $productId, PDO::PARAM_INT);
		$stmt->execute();
	} else if ($pingback->isCancelable()) {
	// withdraw the product
	} 
	echo 'OK'; // Paymentwall expects response to be OK, otherwise the pingback will be resent
} else {
	echo $pingback->getErrorSummary();
}
?>