<?php
include("../../system.admin.php");

$sql = 'SELECT* From '.$DB_PREF.'rssnews';
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();	
echo $resultat;
unset($req);
?>