<?php
include("../../system.admin.php");
$contenu="";
if ((isset($_POST['Table']) && !empty($_POST['Table'])) && (isset($_POST['Num']) && !empty($_POST['Num']))) 
{
			$sql="SELECT* FROM ".$DB_PREF.$_POST['Table']." WHERE Num=".$_POST['Num'] ;
			$req=new DatabaseRequest($sql);
			$resultat=$req->Select();
			unset($req);//tuer l'objet
			if($resultat!=false)
			{
				$contenu=$resultat[0]['Contenu']; //exemple d'affichage
			}
			else
			{
				$contenu="Aucun enregistrement ne corespon a ce parametre";
			}	
			
}
else
{
$contenu="Aucun element selectione";
}
echo utf8_encode( $contenu) ;
?>