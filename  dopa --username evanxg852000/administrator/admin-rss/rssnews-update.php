<?php
include("../../system.admin.php");
$action  = $_POST['action'];

Switch ($action){
	Case 'update':
			$sql = "UPDATE ".$DB_PREF."rssnews SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'insert':
			$sql = "INSERT INTO ".$DB_PREF."rssnews (Num,Titre,Lien,Description,Date) VALUES ( ".$_POST['Num'].",'".$_POST['Titre']."','',0,'')";
	Break;
	Case 'delete':
			$sql = "DELETE FROM ".$DB_PREF."rssnews WHERE Num = ".$_POST['Num'];
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
