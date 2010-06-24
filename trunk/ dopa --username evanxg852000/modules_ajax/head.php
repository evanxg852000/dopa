<?php
//permet de charger les librairie javascript ,ajax ,les entete de page 
// depend du mode ajax ou default
function head()
{    
	   Global $LANG,$template,$MODE;
	   $style=$template;
	    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
	    echo '<head>';
        echo '<title>'.$LANG['title'].'</title>';
		echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		echo '<meta name="description" content="'.$LANG['description'].'" />';
		echo '<meta name="keywords" content="'.$LANG['keywords'].'" />'; //doit figurer pour chaque page
		echo '<meta name="Generator" content="'.$LANG['Generator'].'" />';
		echo '<meta name="robots" content="'.$LANG['robots'].'" />';
		echo '<LINK rel="stylesheet" href="templates/'.$style.'/css/style.css" type="text/css">';
   		echo '<link rel="shortcut icon" href="templates/'.$style.'/favicon.ico" />';
		
		 //echo '<script language="JavaScript" type="text/javascript" src="library/extjs/"></script>';
//<!-- divers -->
		echo '<script type="text/javascript" src="library/evanjs/horloge.js"></script>';
		echo '<script type="text/javascript" src="library/evanjs/calender.js"></script>';
//<!-- /divers -->
//<!-- library extjs 2.2-->
		seulement si le mode est ajax
		if ($MODE=='ajax') {
		echo '<link rel="stylesheet" type="text/css" href="library/extjs/resources/css/ext-all.css" />';
		echo '<script type="text/javascript" src="library/extjs/adapter/ext/ext-base.js"></script>';
		echo '<script type="text/javascript" src="library/extjs/ext-all.js"></script>';
		}
//<!-- /library -->
        echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/SpryCollapsiblePanel.js"></script>';
		echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/tab.js"></script>';
        echo '<script language="JavaScript" type="text/javascript" src="library/evanjs/fonction.js"></script>';
		echo '</head>';
}       
?>