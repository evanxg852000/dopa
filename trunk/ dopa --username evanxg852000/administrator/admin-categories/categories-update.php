<?php
// $sql = "UPDATE  ".$DB_PREF."categorie SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
include("../../system.admin.php");

	$action  = $_POST['action'];

Switch ($action){
	Case 'insert':
		$sql = "INSERT INTO ".$DB_PREF."categorie ( Num , Nom , Publie) VALUES ( ".$_POST['Num'].",'".$_POST['Nom']."','N')";
	Break;
	Case 'update':
		$sql = "UPDATE  ".$DB_PREF."categorie SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."categorie WHERE Num = ".$_POST['Num'];
	Break;
	Case 'depublie':
		$sql = "UPDATE ".$DB_PREF."categorie SET Publie='N' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'publie':
		$sql = "UPDATE ".$DB_PREF."categorie SET Publie='Y' WHERE Num = ".$_POST['Num'];
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