<?php
include("../../system.admin.php");
	$valeur = $_POST['Type'];
	$sql = "UPDATE ".$DB_PREF."menu SET Type='".$valeur."' WHERE Num =1";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Request();	
	unset($req);
	if ($resultat)
	{
		echo '{success:true, msg:'.json_encode('Changement effectue avec succes').'}';
	}
	else
	{
		echo '{success:true, msg:'.json_encode('Impossible de changer le type').'}';
	}
?>