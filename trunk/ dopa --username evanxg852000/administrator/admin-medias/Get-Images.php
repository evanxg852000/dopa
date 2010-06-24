<?php
include("../../system.admin.php");

$dir ="../../media/".$_POST['Repertoire']."/"; 
$rep=$_POST['Repertoire'];
switch($rep)
{
	case 'images':
		$dir_bis="../media/images/";
	break;
	case 'album':
		$dir_bis="../media/album/";
	break;
	case 'icons':
		$dir_bis="../media/icons/";
	break;
	case 'banner':
		$dir_bis="../media/banner/";
	break;
}

$images = array();
$d = dir($dir);
while($name = $d->read()){
    if(!preg_match('/\.(jpg|gif|png)$/', $name)) continue;
    $size = filesize($dir.$name);
    $lastmod = filemtime($dir.$name)*1000;
    $images[] = array('name'=>$name, 'size'=>$size, 
			'lastmod'=>$lastmod, 'url'=>$dir_bis.$name);
}
$d->close();
$o = array('images'=>$images);
echo json_encode($o);
?>