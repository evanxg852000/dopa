<?php
include("../../system.admin.php");

$sql = 'SELECT* From sondage ';
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();	
echo $resultat;
unset($req);
?>