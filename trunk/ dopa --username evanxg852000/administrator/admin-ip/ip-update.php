<?php
include("../../system.admin.php");
$action  = $_POST['action'];

Switch ($action){
	Case 'update':
		$sql = "UPDATE compteur SET ".$_POST['field']." = '".$_POST['value']."' WHERE ipCon = '".$_POST['ipCon']."'";
	Break;
	Case 'insert':
	      $sql="INSERT INTO `compteur` ( `ipCon` , `heureCon` , `dateCon` , `lheure` , `Nb_charg` , `Etat` ) VALUES ('".$_POST['ipCon']."', '".$_POST['heureCon']."', '".$_POST['dateCon']."', '".$_POST['lheure']."', '0', 'Y');"; 
	Break;
	Case 'delete':
		$sql = "DELETE FROM compteur WHERE ipCon = '".$_POST['ipCon']."'";
	Break;
	Case 'debloc':
		$sql = "UPDATE compteur SET Etat='N',Nb_charg=0 WHERE ipCon = '".$_POST['ipCon']."'";
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