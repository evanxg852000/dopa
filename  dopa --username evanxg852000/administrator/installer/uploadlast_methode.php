<?php
$tableau_fichier=$_FILES; 
$type_autorise=array(1=>"image/jpg",2=>"image/png",3=>"image/bmp");
$repertoire_upload=$PATH_ROOT."media/".$_POST['repertoire']."/" ;
$test=upload($tableau_fichier,$repertoire_upload,$type_autorise); 

if($test==true)
{
echo '{success:true, msg:'.json_encode('Fichier uploader avec succes').'}';
}
else
{
echo '{success:true, msg:'.json_encode('Echeque de transfert du fichier').'}';
}
?>