<?php
include("../../system.admin.php");

$sql = 'SELECT* From '.$DB_PREF.'compteur';
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();	
echo $resultat;
unset($req);
?>