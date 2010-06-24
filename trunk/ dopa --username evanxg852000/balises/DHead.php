<?php
//permet de charger les librairie javascript ,ajax ,les entete de page 
// depend du mode ajax ou default
function DHead($myheadtag)
{    
		
	   Global $LANG,$DESIGN,$MODE,$LANGAGE,$TITLE,$AUTHOR,$DESCRIPTION,$GENERATOR,$ROBOT,$KEYWORDS;
	   $style=$DESIGN;
	 
	    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n";
		echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$LANGAGE.'" lang="'.$LANGAGE.'">'."\n";
	    echo '<head>'."\n";
        echo '<title>'.$TITLE.'</title>'."\n";
		echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />'."\n";
		echo '<meta name="description" content="'.$DESCRIPTION.'" />'."\n";
		echo '<meta name="author" content="'.$AUTHOR.'" />'."\n";
		echo '<meta name="keywords" content="'.$KEYWORDS.'" />'."\n"; //doit figurer pour chaque page
		echo '<meta name="Generator" content="'.$GENERATOR.'" />'."\n";
		echo '<meta name="robots" content="'.$ROBOT.'" />'."\n";
		echo '<LINK rel="stylesheet" href="design/'.$style.'/css/style.css" type="text/css"> '."\n";
		echo '<LINK rel="stylesheet" href="design/system/system.css" type="text/css"> '."\n";
   		echo '<link rel="shortcut icon" href="favicon/favicon.ico" /> '."\n";
		echo $myheadtag."\n";
		
		 //echo '<script language="JavaScript" type="text/javascript" src="library/extjs/"></script>';
//<!-- divers -->
		echo '<script type="text/javascript" src="library/evanjs/horloge.js"></script> '."\n";
		echo '<script type="text/javascript" src="library/evanjs/calender.js"></script> '."\n";
//<!-- /divers -->
//<!-- library extjs 2.2-->
		//seulement si le mode est ajax
		if ($MODE=='ajax') {
		echo '<link rel="stylesheet" type="text/css" href="library/extjs/resources/css/ext-all.css" /> '."\n";
		echo '<script type="text/javascript" src="library/extjs/adapter/ext/ext-base.js"></script> '."\n";
		echo '<script type="text/javascript" src="library/extjs/ext-all.js"></script>'."\n";
		}
//<!-- /library -->
        echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/SpryCollapsiblePanel.js"></script> '."\n";
		echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/tab.js"></script> '."\n";
        echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/fonctions.js"></script>'."\n";
		echo '</head> '."\n";
}       
?>