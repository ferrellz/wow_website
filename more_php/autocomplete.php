<?php
/*
	The PHP code that helps autocomplete to get existing suggestions for character names from our database.
*/
require("db_connect_characters.php");

$term = $_GET['term'];
$a_json = array();
$a_json_row = array();
$stmt = $dbh->prepare("SELECT * FROM characters WHERE name LIKE :term ORDER BY name");
$stmt->execute(array(':term' => '%'.$term.'%'));

while($row1 = $stmt->fetch(PDO::FETCH_ASSOC))
	array_push($a_json, $row1['name']);

//JSON that up and echo it back
echo json_encode($a_json);
flush();
?>