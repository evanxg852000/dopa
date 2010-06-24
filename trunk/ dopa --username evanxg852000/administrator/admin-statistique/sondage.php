<?php
include("../../system.admin.php");

$sql = 'SELECT* From '.$DB_PREF.'sondage ';
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();	
echo $resultat;
unset($req);
?>