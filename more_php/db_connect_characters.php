<?php
/*
	Connects to the characters database.
*/
$dsn      = 'mysql:host=127.0.0.1;dbname=characters;';
$login    = 'root';
$password = 'password';
$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
try {
	$dbh = new PDO($dsn, $login, $password, $options);
} catch (PDOException $e) {
    print "Can't connect to database. :(";
    die();
}
?>