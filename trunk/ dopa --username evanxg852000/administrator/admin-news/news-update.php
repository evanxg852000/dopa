<?php
include("../../system.admin.php");
$action  = $_POST['action'];
	
Switch ($action){
	Case 'update':
		$sql = "UPDATE ".$DB_PREF."news SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'insert':
			$sql = "INSERT INTO ".$DB_PREF."news (Num,Nom,Contenu,Publie,Date) VALUES ( ".$_POST['Num'].",'".$_POST['Nom']."','','Y','".$_POST['Date']."')";
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."news WHERE Num = ".$_POST['Num'];
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