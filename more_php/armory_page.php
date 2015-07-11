<?php
/*
	Much of the functionality behind the armory page. Make sure the name is set correctly, use !isset to avoid
	throwing errors when refreshing/visiting the page in first place.
*/
$errorMsg;
$returnError = false;

if (!isset($_POST['charname']))
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
	require("meaty_php/db_connect_characters.php");
	
	$charname=$_POST['charname'];
	$charname = ucwords($charname);
	//Check if the characters name exists or not
	$qry = $dbh->prepare("SELECT name FROM characters WHERE name = :name");
	$qry->execute(array('name' => $charname));
	$name = $qry->fetchColumn();

	if ($name=="") {
		//name didn't exist
		$errorMsg = "I-I'm sorry senpai, but... but the character name doesn't exist!! ;_;";
		$returnError = true;
		unset($qry);
	};
}
function returnDisplayPath($inventorySlot){
		global $dbh;
		$fetchDisplayPath = $dbh->query('SELECT path FROM item_display_info WHERE itemId = "'.$inventorySlot.'"') ;
		$itemDisplayPath = "0";
		if($fetchDisplayPath->rowCount() > 0)
			$itemDisplayPath = $fetchDisplayPath->fetchColumn();;
		return $itemDisplayPath;
}
	

function returnTitle($id, $name){
	switch($id){
		case 0: return "$name";
		case 1: return "Private $name";
		case 2: return "Corporal $name";
		case 3: return "Sergeant $name";
		case 4: return "Master Sergeant $name";
		case 5: return "Sergeant Major $name";
		case 6: return "Knight $name";
		case 7: return "Knight-Lieutenant $name";
		case 8: return "Knight-Captain $name";
		case 9: return "Knight-Champion $name";
		case 10: return "Lieutenant Commander $name";
		case 11: return "Commander $name";
		case 12: return "Marshal $name";
		case 13: return "Field Marshal $name";
		case 14: return "Grand Marshal $name";
		case 15: return "Scout $name";
		case 16: return "Grunt $name";
		case 17: return "Sergeant $name";
		case 18: return "Senior Sergeant $name";
		case 19: return "First Sergeant $name";
		case 20: return "Stone Guard $name";
		case 21: return "Blood Guard $name";
		case 22: return "Legionnaire $name";
		case 23: return "Centurion $name";
		case 24: return "Champion $name";
		case 25: return "Lieutenant General $name";
		case 26: return "General $name";
		case 27: return "Warlord $name";
		case 28: return "High Warlord $name";
		case 29: return "Gladiator $name";
		case 30: return "Duelist $name";
		case 31: return "Rival $name";
		case 32: return "Challenger $name";
		case 33: return "Scarab Lord $name";
		case 34: return "Conqueror $name";
		case 35: return "Justicar $name";
		case 36: return "$name, Champion of the Naruu";
		case 37: return "Merciless Gladiator $name";
		case 38: return "$name of the Shattered Sun";
		case 39: return "$name, Hand of A'dal";
		case 40: return "Vengeful Gladiator $name";
		}
}

if(!$returnError){
	//fetch equipment/misc data, race, gender and lifetime HK's
	$data= $dbh->query('SELECT data, race, gender, totalKills FROM characters WHERE name = "'.$name.'" ');
	$result= $data->fetch(PDO::FETCH_ASSOC);
	$gear = explode(" ", $result['data']);
	
	$maxhk = $result['totalKills'];
	$raceinteger = $result['race'];
	$genderinteger = $result['gender'];
	$race = "";
	$gender = "";

	if($genderinteger > 0){
		$gender = "female";
	} else $gender = "male";

	switch ($raceinteger)
	{
		case 1: $race = "human"; break;
		case 2: $race = "orc"; break;
		case 3: $race = "dwarf"; break;
		case 4: $race = "nightelf"; break;
		case 5: $race = "undead"; break;
		case 6: $race = "tauren"; break;
		case 7: $race = "gnome"; break;
		case 8: $race = "troll"; break;
		case 10: $race = "bloodelf"; break;
		case 11: $race = "draenei"; break;
	}
	$racegender = $race.$gender;

	// Equipment
	$head = $gear[346];// HEAD
	$headench = $gear[347]; //HEAD ENCHANT
	$neck = $gear[362]; //NECK
	$shoulder= $gear[378]; //SHOULDERS
	$shoulderench= $gear[379]; //SHOULDERS ENCHANT
	$cloak= $gear[570]; //BACK/CLOAK
	$cloakench= $gear[571]; //BACK/CLOAK
	$chest= $gear[410]; //CHEST
	$chestench= $gear[411]; //CHEST
	$shirt= $gear[394]; //SHIRT
	$tabard= $gear[634]; //TABARD
	$wrist= $gear[474];//WRIST
	$wristench= $gear[475];//WRIST

	$hand= $gear[490];//HAND
	$handench= $gear[491];//HAND
	$waist= $gear[426];//WAIST/BELT
	$legs= $gear[442];//LEGS
	$feet= $gear[458];//FEET
	$feetench= $gear[459];//FEET
	$ring1= $gear[506];//RING 1
	$ring2= $gear[522];//RING 2
	$trinket1= $gear[538];//TRINKET 1
	$trinket2= $gear[554];//TRINKET 2

	$weap1= $gear[586];//MAIN HAND
	$weap1ench= $gear[587];//MAIN HAND
	$weap2= $gear[602];//OFF HAND
	$weap2ench= $gear[603];//OFF HAND
	$ranged= $gear[618];//RANGED/IDOL
	$rangedench= $gear[619];//RANGED/IDOL

	$maxhp = $gear[28];//MAX HP
	$maxmana = $gear[29];//MAX MANA
	$strength = $gear[171];
	$agility = $gear[172];
	$intellect = $gear[174];
	$spirit = $gear[175];
	$stamina = $gear[173];
	$armor = $gear[186];
	
	//Fetch Display IDs
	$weap1display = returnDisplayPath($weap1);
	$weap2display = returnDisplayPath($weap2);
	$rangeddisplay = returnDisplayPath($ranged);
	$headdisplay = returnDisplayPath($head);
	$shoulderdisplay = returnDisplayPath($shoulder);
	$neckdisplay = returnDisplayPath($neck);
	$cloakdisplay = returnDisplayPath($cloak);
	$chestdisplay = returnDisplayPath($chest);
	$shirtdisplay = returnDisplayPath($shirt);
	$tabarddisplay = returnDisplayPath($tabard);
	$wristdisplay = returnDisplayPath($wrist);
	$handdisplay = returnDisplayPath($hand);
	$waistdisplay = returnDisplayPath($waist);
	$legsdisplay = returnDisplayPath($legs);
	$feetdisplay = returnDisplayPath($feet);
	$ring1display = returnDisplayPath($ring1);
	$ring2display = returnDisplayPath($ring2);
	$trinket1display = returnDisplayPath($trinket1);
	$trinket2display = returnDisplayPath($trinket2);
	
	$firstDisplay = false;
	//Fetch the IDs for the weapons and merge our item display IDs so we can pass it to our 3d model
	function returnDisplayID($entry, $inventorySlot){
		global $dbh;
		global $firstDisplay;
		$fetchquery = $dbh->query('SELECT displayid FROM world.item_template WHERE entry = "'.$entry.'"') ;
		$str = "";
		if($fetchquery->rowCount() > 0){
			$tempID = $fetchquery->fetchColumn();
			if(!$firstDisplay){
				$str = "$inventorySlot,$tempID"; 
				$firstDisplay=true;
			} else $str = ",$inventorySlot,$tempID";
		} else return;
		return $str;
	}
	
	$equiplist = "";
	$equiplist = "$equiplist".returnDisplayID($weap1, 21);
	$equiplist = "$equiplist".returnDisplayID($weap2, 22);
	$equiplist = "$equiplist".returnDisplayID($head, 1);
	$equiplist = "$equiplist".returnDisplayID($shoulder, 3);
	$equiplist = "$equiplist".returnDisplayID($cloak, 16);
	$equiplist = "$equiplist".returnDisplayID($chest, 5);
	$equiplist = "$equiplist".returnDisplayID($shirt, 4);
	$equiplist = "$equiplist".returnDisplayID($tabard, 19);
	$equiplist = "$equiplist".returnDisplayID($wrist, 9);
	$equiplist = "$equiplist".returnDisplayID($hand, 10);
	$equiplist = "$equiplist".returnDisplayID($waist, 6);
	$equiplist = "$equiplist".returnDisplayID($legs, 7);
	$equiplist = "$equiplist".returnDisplayID($feet, 8);
	
	$guildid = $gear[237]; //  guild id and name
	$fetchguild= $dbh->query('SELECT name FROM guild WHERE guildid = "'.$guildid.'"') ;
	if ($fetchguild->rowCount() > 0){
		$guildname= $fetchguild->fetchColumn();
	} else $guildname = null;
		
	
	//Title
	$title = returnTitle($gear[648], $name);
}
?>