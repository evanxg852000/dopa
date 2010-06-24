<?php
include("../../system.admin.php");
$type_autorise=array(0=>"image/gif",1=>"image/png",2=>"image/bmp",3=>"image/jpg",4=>"image/jpeg");
$repertoire_upload=$PATH_ROOT."media/".$_POST['repertoire']."/" ;
$downfile=new DownloadUpload($repertoire_upload,$type_autorise);
$test=$downfile->Upload($_FILES);
if($test==true)
{
echo '{success:true, msg:'.json_encode('Fichier uploader avec succes').'}';
}
else
{
echo '{success:true, msg:'.json_encode('Echeque de transfert du fichier').'}';
}
?>