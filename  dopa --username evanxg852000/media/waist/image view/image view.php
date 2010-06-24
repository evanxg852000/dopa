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
   array_multisort($image, SORT_ASC); 
   return $image;
}

?>
<title>Image viewer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="image_view.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
//===============================================================..
$image=lister_image("images/");
$default="default.png"; //image par default
$default_caption="default.png";
$k=0; //compteur indice du tableau image;

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