<!DOCTYPE html>
<?php
/*
	The visuals for the honorable kills ranking page. Shows the top ten characters with most honorable kills.
*/
require("more_php/db_connect_characters.php");
require("more_php/check_tos.php");
require("more_php/honorable_kills_functions.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="wowcss/generic_style.css">
</head>
<div class="wrapper">
<body>

<?php include 'headerNavbar.html'; ?>	
	
<div class="content">
<h1>Honorable Kills</h1>
<table><tr><td>Rank<td>Name</td><td>Kills</td></tr>
<?php
$rank = 0;
$stmt = $dbh->query('SELECT totalKills, name, race, gender, class FROM characters ORDER BY totalKills DESC LIMIT 10');
while ($row1 = $stmt->fetch(PDO::FETCH_ASSOC))
{     
    $rank++;
    echo '<tr><td>'.$rank.'</td>
	<td>'.returnrace($row1['gender'], $row1['race']).''.returnclass($row1['class']).'<b>&#160;&#160;'.$row1['name'].'</td>
	<td>'.$row1['totalKills'].'</td>';
}
?>
</table>
</div>
</body>
</div>
<?php include 'footer.html'; ?>

</html>