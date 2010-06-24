<?php
include("../../system.admin.php");

	$action  = $_POST['action'];

Switch ($action){
	Case 'default':
			$sql = "UPDATE ".$DB_PREF."template SET Etat=0 ";
			$req=new DatabaseRequest($sql);
			$resultat=$req->Request();	
			unset($req);
			if ($resultat==true)
			{
				$sql = "UPDATE ".$DB_PREF."template SET Etat=1  WHERE Num = ".$_POST['Num'];
			}
	Break;
	Case 'delete':
			$sql = "DELETE FROM ".$DB_PREF."template WHERE Num = ".$_POST['Num'];
	Break;
}
			$req=new DatabaseRequest($sql);
			$resultat=$req->Request();	
			unset($req);
If ($resultat==true) {
	
		Echo '{success:true}';
}else{
	
	Echo '{success:false}';	
}

?>