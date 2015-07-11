<!DOCTYPE html>
<?php
/*
	Our very own kinda hacky armory! Yay!
	This is based on an old design where I didn't know better than to use tables for page layout. Since it's a
	cumbersome job to change the layout of this page the table layout will stay, at least for a while.
	We use Openwow's website for the links, and steal the icons for the items from a resource site used by Wowhead.
	Wowhead also provides us the 3D model viewer with the correct race, gender and equipment of a specific character.
*/
require("more_php/check_tos.php");
require("more_php/armory_page.php");
?>
<html>
<head>
<script type="text/javascript" src="http://cdn.openwow.com/api/tooltip.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="wowcss/armory_style.css">
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
	<form method="post" action="armory">
		<label for="tags">Character Name: </label>
		<input maxlength="12" id="tags" name="charname" type ="text" >
		<input name="Submit" type="submit" value="Search!" />
	</form>
</div>
	
<?php if(!$returnError) : ?>	
	<div class="content">
		<div id = "showCharacter" style="position: relative; left: 0; top: 0;">
		<table class = "charTable">
			<tr><td></td><td><p style="font-family: Verdana,Arial,sans-serif;
			font-size: 1.1em;color:#6d6eda;z-index:-1;"><?php echo "$title";?></p>
			<br></br>
			<?php if($guildname != ""):?>
			<p style="font-family: Verdana,Arial,sans-serif;
			font-size: 1.1em;color:#6d6eda;width:100px;position:relative;left:50px;top:0;z-index:-1;">
			<?php echo htmlentities("<$guildname>");?></p><?php else : ?><br><?php endif;?></td></tr>
			<td>
			    <img src="images\empty-slot-head.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-neck.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-shoulder.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-back.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-chest.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-shirt.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-tabard.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-wrists.png" style="position: relative; top: 0; left: 0;">
				
				<!--head-->
				<?php if($head != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$head";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$headdisplay.jpg";?>" style="position: absolute; top: 62px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--neck-->
				<?php if($neck != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$neck";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$neckdisplay.jpg";?>" style="position: absolute; top: 136px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--shoulder-->
				<?php if($shoulder != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$shoulder";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$shoulderdisplay.jpg";?>" style="position: absolute; top: 210px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--cloak-->
				<?php if($cloak != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$cloak";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$cloakdisplay.jpg";?>" style="position: absolute; top: 284px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--chest-->
				<?php if($chest != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$chest";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$chestdisplay.jpg";?>" style="position: absolute; top: 358px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--shirt-->
				<?php if($shirt != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$shirt";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$shirtdisplay.jpg";?>" style="position: absolute; top: 432px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--tabard-->
				<?php if($tabard != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$tabard";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$tabarddisplay.jpg";?>" style="position: absolute; top: 506px; left: 187px;">
				</a>
				<?php endif; ?>
				<!--wrist-->
				<?php if($wrist != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$wrist";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$wristdisplay.jpg";?>" style="position: absolute; top: 580px; left: 187px;">
				</a>
				<?php endif; ?>
			</td>
		 <td><object data="http://static.wowhead.com/modelviewer/ModelView.swf" width="290px" height="400px" type="application/x-shockwave-flash"> 
		  <param value="high" name="quality" /> 
		  <param value="transparent" name="wmode" /> 
		  <param value="always" name="allowsscriptaccess" /> 
		  <param value="false" name="menu" /> 
		  <param value="model=<?php echo "$racegender";?>&amp;modelType=16&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1&amp;equipList=<?php echo "$equiplist";?>" name="flashvars" /> 
		  <param movie="http://static.wowhead.com/modelviewer/modelviewer_scale.swf?4" /> 
		</object></td>
			<td>
				
				<img src="images\empty-slot-hands.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-waist.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-legs.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-feet.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-finger.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-finger.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-trinket.png" style="position: relative; top: 0; left: 0;"><br></br>
				<img src="images\empty-slot-trinket.png" style="position: relative; top: 0; left: 0;">
				<!--hands-->
				<?php if($hand != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$hand";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$handdisplay.jpg";?>" style="position: absolute; top: 62px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--waist-->
				<?php if($waist != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$waist";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$waistdisplay.jpg";?>" style="position: absolute; top: 136px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--legs-->
				<?php if($legs != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$legs";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$legsdisplay.jpg";?>" style="position: absolute; top: 210px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--feet-->
				<?php if($feet != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$feet";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$feetdisplay.jpg";?>" style="position: absolute; top: 284px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--ring1-->
				
				<?php if($ring1 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$ring1";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$ring1display.jpg";?>" style="position: absolute; top: 358px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--ring2-->
				<?php if($ring2 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$ring2";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$ring2display.jpg";?>" style="position: absolute; top: 432px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--trinket1-->
				<?php if($trinket1 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$trinket1";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$trinket1display.jpg";?>" style="position: absolute; top: 506px; left: 756px;">
				</a>
				<?php endif; ?>
				<!--trinket2-->		
				<?php if($trinket2 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$trinket2";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$trinket2display.jpg";?>" style="position: absolute; top: 580px; left: 756px;">
				</a>
				<?php endif; ?>
			</td>
			<tr>
			<td></td><td>
				<!--main hand-->
				<img src="images\empty-slot-mainhand.png" style="position: relative; top: 0; left: 0;">
				<img src="images\empty-slot-secondaryhand.png" style="position: relative; top: 0; left: 0;">
				<img src="images\empty-slot-ranged.png" style="position: relative; top: 0; left: 0;">
				<?php if($weap1 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$weap1";?>">
					<img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$weap1display.jpg";?>" style="position: absolute; top: 650px; left: 403px;">
				 </a>
				<?php endif; ?>
				<!--off hand-->
				<?php if($weap2 != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$weap2";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$weap2display.jpg";?>"  style="position: absolute; top: 650px; left: 472px;">
				</a>
				<?php endif; ?>
				<!--ranged-->
				<?php if($ranged != 0) : ?>
				<a href="<?php echo "http://wotlk.openwow.com/item=$ranged";?>">
				  <img src="<?php echo "http://wow.zamimg.com/images/wow/icons/large/$rangeddisplay.jpg";?>" style="position: absolute; top: 650px; left: 541px;">
				</a>
				<?php endif; ?>
			</td>
			</tr>
			<tr><td></td><td><br></br><br></br>
			<div class="rectangle"></div>
			<p style="font-family: Verdana,Arial,sans-serif;
			font-size: 1.1em;color:white;position:absolute;top:762px;left:475px"><?php echo "$maxhp";?></p>
			<?php if($maxmana != 0) : ?>
				<div class="rectangle2"></div>
				<p style="font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;color:white;position:absolute;top:797px;left:475px"><?php echo "$maxmana";?></p>
			<?php endif; ?>
			<br></br>
			<p style="font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em">Strength: <?php echo "$strength" ;?></p>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Agility: <?php echo "$agility" ;?></p>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Stamina: <?php echo "$stamina" ;?></p>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Intellect: <?php echo "$intellect" ;?></p>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Spirit: <?php echo "$stamina" ;?></p>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Armor: <?php echo "$armor" ;?></p>
				<br>
			<p style="margin:10px;font-family: Verdana,Arial,sans-serif;
				font-size: 1.1em;">Honorable Kills: <?php echo "$maxhk" ;?></p>
			</td></tr>
		</table>
	</div>
		</div>
<?php else: ?>
	<p class="errorMsg"><?php echo "$errorMsg";?></p>
<?php endif; ?>
	
</body>
</div>

<?php include 'footer.html'; ?>
</html>