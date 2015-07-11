<?php
/*
	Two simple functions that return a thumbnail of the correct class and race/gender depending on the ID's
	that are used in the database to represent them.
*/
function returnclass($b)
{
  switch ($b)
  {
    case 1: return "<img src=\"http://127.0.0.1/Ladder/Warrior.gif\" border=0>";
    case 2: return "<img src=\"http://127.0.0.1/Ladder/Paladin.gif\" border=0>";
    case 3: return "<img src=\"http://127.0.0.1/Ladder/Hunter.gif\" border=0>";
    case 4: return "<img src=\"http://127.0.0.1/Ladder/Rogue.gif\" border=0>";
    case 5: return "<img src=\"http://127.0.0.1/Ladder/Priest.gif\" border=0>";
    case 7: return "<img src=\"http://127.0.0.1/Ladder/Shaman.gif\" border=0>";
    case 8: return "<img src=\"http://127.0.0.1/Ladder/Mage.gif\" border=0>";
    case 9: return "<img src=\"http://127.0.0.1/Ladder/Warlock.gif\" border=0>";
    case 11: return "<img src=\"http://127.0.0.1/Ladder/Druid.gif\" border=0>";
  }
}

function returnrace($g, $r)
{	
	switch($g)
	{
		case 0://male
			switch ($r)
			{
				case 1: return "<img src=\"http://127.0.0.1/Ladder/Human_Male.gif\" border=0>";
    			case 2: return "<img src=\"http://127.0.0.1/Ladder/Orc_Male.gif\" border=0>";
    			case 3: return "<img src=\"http://127.0.0.1/Ladder/Dwarf_Male.gif\" border=0>";
    			case 4: return "<img src=\"http://127.0.0.1/Ladder/NightElf_Male.gif\" border=0>";
    			case 5: return "<img src=\"http://127.0.0.1/Ladder/Undead_Male.gif\" border=0>";
				case 6: return "<img src=\"http://127.0.0.1/Ladder/Tauren_Male.gif\" border=0>";
    			case 7: return "<img src=\"http://127.0.0.1/Ladder/Gnome_Male.gif\" border=0>";
   				case 8: return "<img src=\"http://127.0.0.1/Ladder/Troll_Male.gif\" border=0>";
				case 10: return "<img src=\"http://127.0.0.1/Ladder/BloodElf_Male.gif\" border=0>";
    			case 11: return "<img src=\"http://127.0.0.1/Ladder/Draenei_Male.gif\" border=0>";		
			}
		case 1://female
			switch ($r)
			{
				case 1: return "<img src=\"http://127.0.0.1/Ladder/Human_Female.gif\" border=0>";
    			case 2: return "<img src=\"http://127.0.0.1/Ladder/Orc_Female.gif\" border=0>";
    			case 3: return "<img src=\"http://127.0.0.1/Ladder/Dwarf_Female.gif\" border=0>";
    			case 4: return "<img src=\"http://127.0.0.1/Ladder/NightElf_Female.gif\" border=0>";
    			case 5: return "<img src=\"http://127.0.0.1/Ladder/Undead_Female.gif\" border=0>";
				case 6: return "<img src=\"http://127.0.0.1/Ladder/Tauren_Female.gif\" border=0>";
    			case 7: return "<img src=\"http://127.0.0.1/Ladder/Gnome_Female.gif\" border=0>";
   				case 8: return "<img src=\"http://127.0.0.1/Ladder/Troll_Female.gif\" border=0>";
				case 10: return "<img src=\"http://127.0.0.1/Ladder/BloodElf_Female.gif\" border=0>";
    			case 11: return "<img src=\"http://127.0.0.1/Ladder/Draenei_Female.gif\" border=0>";
			}
	}
}
?>