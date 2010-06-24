<?php

include("../../system.admin.php");

	$action  = $_POST['action'];

	Switch ($action)
	{
	Case 'update':
		$sql = "UPDATE ".$DB_PREF."reponse SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'insert':
			$sql = "INSERT INTO ".$DB_PREF."reponse ( Num , Reponse , Num_so ) VALUES (Null,'".$_POST['Reponse']."',".$_POST['Num_so'].")";
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."reponse WHERE Num = ".$_POST['Num'];
	Break;
	}
 
	$req=new DatabaseRequest($sql);
	$resultat=$req->Request();	
	If ($resultat==true) {
		
			Echo '{success:true}';
	}else{
		
		Echo '{success:false}';	
	}
	unset($req);
?>
