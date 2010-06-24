<?php
include("../system.admin.php")
?>
<?xml version="1.0" encoding="iso-8859-1"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "
http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php //on verifie ici car on veut conaitre le rep et metre ca en titre

if((!isset($_GET['repertoire']))&&(!isset($_GET['param'])) )
{
	$k=0; 			//compteur indice du tableau image
	$dir="images/";
}
else
{
	$k=$_GET['param'];
	$dir=$_GET['repertoire'];
};


?>
<title>Dopa 0.2 | Media viewer| Repertoire: <?php echo $dir ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style/image_view.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

$image=lister_image($dir);
$default="style/default.png"; //image par default
$default_caption="default.png";


echo '<table width="535">';
for($i=0;$i<4;$i++)
{
	echo '<tr>';	
			echo '<td>';
	for($j=0;$j<4;$j++)
	{
				echo'<div class="mosimage"  style=" border-width: 1px; float: left; width: 120px;" align="center">';
						echo '<img src="';if($image[$k][name]==''){	echo $default;}	else {echo $image[$k][name];}echo'" width="116" height="67"  alt="Image view" title="';if($image[$k][name]==''){echo $default_caption;;}	else {echo $image[$k][caption];}echo'" border="0" />';
						echo '<div class="mosimage_caption" style="text-align: center;" align="center">';if($image[$k][name]==''){	echo $default_caption;}	else {echo $image[$k][caption];} echo'</div>';
				echo '</div>';
				$k++;
	}
			echo '</td>';
		echo '</tr>';
}
echo '</table>';
?>
<table width="533">
<tr><td>
<fieldset class="input">
<A href="image_view.php?repertoire=album/&param=0" alt="Repertoitre album"><img src="style/album.png" /> </A>
<A href="image_view.php?repertoire=banner/&param=0"><img src="style/banner.png"/> </A>
<A href="image_view.php?repertoire=icons/&param=0"><img src="style/icons.png"/> </A>
<A href="image_view.php?repertoire=images/&param=0"><img src="style/images.png"/> </A>
<?php 
echo '<A href="image_view.php?repertoire='.$dir.'&param=0"><img src="style/previous.png" alt="Precedant"/> </A>';
$nb_page=((count($image))-(count($image)%16))/16; 
//16 est le nombre d'image par page
/*
le nbre de page est egale au reste de la division entre le total image et 16 soustrait au total ce 
qui fait qu'on obtient un nbre entier
*/	

for($i=0;$i<=$nb_page;$i++)
{
	$para=$i*16;
	echo '<A href="image_view.php?repertoire='.$dir.'&param='.$para.'"><img src="style/current.png" alt=""/> </A>';
}
echo '<A href="image_view.php?repertoire='.$dir.'&param='.$para.'"><img src="style/next.png"/ alt="Suivant"/> </A>';

?>

</fieldset>
</td>
</tr>
</table>
</body>
</html>