<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- Copyright (c) 2006-2007. Adobe Systems Incorporated. All rights reserved. -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Grow example</title>
<link href="sample.css" rel="stylesheet" type="text/css" />
<script src="SpryEffects.js" type="text/javascript"></script>
<script type="text/JavaScript">
<!--
initCalled=false;

if (! initCalled) {init()}

function init ()
{
	zindexStart = 1000;  
	initCalled = true;
}

function setzindex(element, effect)
{
	if (effect.direction == Spry.forwards)
	{
	element.style.zIndex=zindexStart;
	
		//seems that IE needs a seperate solution
		if(/MSIE/.test(navigator.userAgent) && /Windows NT/.test(navigator.userAgent))
		{
				Spry.Effect.setStyleProp(	element.parentNode, 'zIndex', zindexStart);
				//element.parentNode.style.zIndex = zindexStart;
		}
	}
	zindexStart++;
}

function resetzindex(element, effect)
{
	if (effect.direction == Spry.backwards)
	{
 		 element.style.zIndex=1;
		
		if(/MSIE/.test(navigator.userAgent) && /Windows NT/.test(navigator.userAgent))
		 {
			Spry.Effect.setStyleProp(	element.parentNode, 'zIndex', 1);
		 }
	}
}
var effects = [];
function toggleThumb(targetElement)
{
	if (typeof effects[targetElement.id] == 'undefined')
	{
		effects[targetElement.id] = new Spry.Effect.Grow(targetElement, {duration: 400, from: '100%', to: '500%', toggle: true, setup:setzindex, finish:resetzindex});
	}
	
	effects[targetElement.id].start();
}

//-->
</script>

</head>
<body>
<form name=form method="post" action="folder.php">
 Nom fichier:<input type=text name="nomfichier"/>
<div class="preview">
<?php
	function getextention( $fic )
	{
		return strtolower(substr($fic, strrpos($fic, '.') + 1));
	}
	
if (!isset($_POST['repertoire'])) $_POST['repertoire'] = '.';

$rep=$_POST['repertoire'];
    $handle=opendir($rep)or die('repertoire non valide');
    $i=0;
	
    while ($file = readdir($handle)) {
		//$type=; 
		
		$type=getextention($file);	
		if ($type=='png'||$type='bmp'||$type=='jpg'||$type=='gif' )
		{
		echo '<div class="thumbnails">';		
		echo '<div><img src="'.$file.'" alt="'.$file.'" name="img'.$i.'" id="img'.$i.'" title="" onclick="toggleThumb(this); document.form.nomfichier.value=\''.$file.'\'"/></div>';
		echo '</div>';
		}
		else
		{
				echo '<div class="thumbnails">';		
				echo '<div><img src="img/default.png" alt="'.$file.'" name="img'.$i.'" id="img'.$i.'" title="" onclick="toggleThumb(this)"/></div>';
				echo '</div>';
		}
		$i++;
    }
	
	
    closedir($handle); 
?>
	 </div>
	
	</form>
	
	
	