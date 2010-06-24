<?php
include("../../system.admin.php");
$action  = $_POST['action'];

Switch ($action){
	Case 'lire':
			$sql= "SELECT* FROM ".$DB_PREF."messages WHERE Num = ".$_POST['Num'];
			$req=new DatabaseRequest($sql);
			$resultat=$req->Select();	
			unset($req);
			$contenu=$resultat[0]['Contenu'];
			
			$sql = "UPDATE ".$DB_PREF."messages SET Lu='Y' WHERE Num = ".$_POST['Num'];
			$req=new DatabaseRequest($sql);
			$resultat=$req->Request();	
			unset($req);
			
			If ($resultat==true) {
				
					Echo $contenu;
			}else{
				
				Echo '{success:false}';	
			}
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."messages WHERE Num = ".$_POST['Num'];
		$req=new DatabaseRequest($sql);
	    $resultat=$req->Request();	
		unset($req);
		If ($resultat==true) {
				Echo '{success:true}';
		}else{
			
			Echo '{success:false}';	
		}
	Break;
}




?>
