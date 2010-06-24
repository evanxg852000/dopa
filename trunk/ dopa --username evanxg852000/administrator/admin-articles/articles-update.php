<?php
include("../../system.admin.php");
$action  = $_POST['action'];
$date=date("D, M d Y");
Switch ($action){
	Case 'insert':
		$sql = "INSERT INTO ".$DB_PREF."article ( Num , Nom ,Publie ,Contenu ,Info ,Publie_ho ,Num_ca) VALUES ( ".$_POST['Num'].",'".$_POST['Nom']."','N','','".$date."','N',0)";
	Break;
	Case 'update':
		$sql = "UPDATE  ".$DB_PREF."article SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."article WHERE Num = ".$_POST['Num'];
	Break;
	Case 'depublie':
		$sql = "UPDATE ".$DB_PREF."article SET Publie='N' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'publie':
		$sql = "UPDATE ".$DB_PREF."article SET Publie='Y' WHERE Num = ".$_POST['Num'];
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