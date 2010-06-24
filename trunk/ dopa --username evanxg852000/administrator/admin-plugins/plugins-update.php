<?php
include("../../system.admin.php");
$action  = $_POST['action'];

Switch ($action){
	Case 'update':
		$sql = "UPDATE ".$DB_PREF."plugins SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."plugins WHERE Num = ".$_POST['Num'];
	Break;
	Case 'depublie':
		$sql = "UPDATE ".$DB_PREF."plugins SET Publie='N' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'publie':
		$sql = "UPDATE ".$DB_PREF."plugins SET Publie='Y' WHERE Num = ".$_POST['Num'];
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