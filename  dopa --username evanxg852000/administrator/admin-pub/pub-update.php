<?php
include("../../system.admin.php");
$action  = $_POST['action'];

Switch ($action){
	Case 'update':
		$sql = "UPDATE ".$DB_PREF."publicite SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num =".$_POST['Num'];
	Break;
	Case 'insert':
	      $sql="INSERT INTO ".$DB_PREF."publicite ( Num , Titre , Lien , Description ,Publie ) VALUES (Null, '".$_POST['Titre']."','http://','','N')"; 
	Break;
	Case 'delete':
		$sql = "DELETE FROM ".$DB_PREF."publicite WHERE Num =".$_POST['Num'];
	Break;
	Case 'publie':
		$sql = "UPDATE ".$DB_PREF."publicite SET Publie='Y' WHERE Num=".$_POST['Num'];
	Break;
	Case 'depublie':
		$sql = "UPDATE ".$DB_PREF."publicite SET Publie='N' WHERE Num=".$_POST['Num'];
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