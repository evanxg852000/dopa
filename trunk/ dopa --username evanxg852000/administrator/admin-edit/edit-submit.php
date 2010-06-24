<?php
include("../../system.admin.php");

if ((isset($_POST['Table']) && !empty($_POST['Table'])) && (isset($_POST['Num']) && !empty($_POST['Num']))) 
{
	$sql = "UPDATE ".$_POST['Table']." SET  Contenu='".utf8_decode($_POST['Contenu'])."' WHERE Num=".$_POST['Num'];
    $req=new DatabaseRequest($sql);
	$resultat=$req->Request();	
	unset($req);
	If ($resultat==true) {
		Echo 'Enregistrement effectue';
	}else{
		
		Echo 'Enregistrement non effectue';	
	}
}
else
{
echo 'Aucun parametre';

}
?>