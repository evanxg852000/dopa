<?php
include("../../system.admin.php");
$sql="SELECT Num,Nom,Fonction,Niv_acces,Mail,Etat FROM ".$DB_PREF."utilisateur where Fonction='admin'";
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();	
echo $resultat;
unset($req);
?>