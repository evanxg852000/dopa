<?xml version="1.0" encoding="iso-8859-1"?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "
http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
function lister_image($repertoire)
{
   $pointeur = opendir($repertoire); 
   $i = 0; 
   while ($fichier = readdir($pointeur)) {
   if (substr($fichier, -3) == "gif" || substr($fichier, -3) == "jpg" || substr($fichier, -3) == "png" ||substr($fichier, -4) == "jpeg" || substr($fichier, -3) == "PNG" || substr($fichier, -3) == "GIF" || substr($fichier, -3) == "JPG")
      {
	   $image[$i][name]= $repertoire.$fichier;
       $image[$i][caption]= $fichier;
       $i++;
      }       
   } 
   closedir($pointeur); 
   if(count($image)>0) //comptage du nbr d'el pour trier
   {
   array_multisort($image, SORT_ASC); 
   }
   
   return $image;
}

?>
<title>Image viewer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style/image_view.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="660">
<tr><td>
<fieldset class="input">
<form method="post" name="critere" action="image_view.php">
<input  type="hidden" name="param" value="0">
<label for="rep">Repertoire:</label>
<select class="inputbox" name="repertoire">
<option>album</option>
<option>banners</option>
<option>icons</option>
<option>images</option>
</select>
<input class="button" type="submit" value="ouvrir"/> <input class="button" type="button" value="suivant" onclick="this.form.param.value=25;this.form.submit()"/>
</form>
</fieldset>
</td>
</tr>
</table>
<?php
//===============================================================..
if((!isset($_POST['repertoire']))&&(!isset($_POST['param'])) )
{
$k=0; //compteur indice du tableau image
$dir="images/";
}
else
{
	$k=$_POST['param'];
	$dir=$_POST['repertoire'].'/';
};

$image=lister_image($dir);
$default="style/default.png"; //image par default
$default_caption="default.png";


echo '<table width="700">';
for($i=0;$i<5;$i++)
{
	echo '<tr>';	
			echo '<td>';
	for($j=0;$j<5;$j++)
	{
				echo'<div class="mosimage"  style=" border-width: 1px; float: left; width: 120px;" align="center">';
						echo '<img src="';if($image[$k][name]==''){	echo $default;}	else {echo $image[$k][name];}echo'" width="116" height="67"  alt="Image view" title="Image view" border="0" />';
						echo '<div class="mosimage_caption" style="text-align: center;" align="center">';if($image[$k][name]==''){	echo $default_caption;}	else {echo $image[$k][caption];} echo'</div>';
				echo '</div>';
				$k++;
	}
			echo '</td>';
		echo '</tr>';
}
echo '</table>';
?>

</body>
</html>