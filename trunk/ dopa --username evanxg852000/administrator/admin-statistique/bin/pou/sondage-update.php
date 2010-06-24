<?php

include("../../system.admin.php");

	$action  = $_POST['action'];

	Switch ($action)
	{
	Case 'update':
		$sql = "UPDATE sondage SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'insert':
			$sql = "INSERT INTO sondage (Num,Nom,Question,Publie) VALUES ( ".$_POST['Num'].",'".$_POST['Nom']."','','N')";
	Break;
	Case 'delete':
		$sql = "DELETE FROM sondage WHERE Num = ".$_POST['Num'];
	Break;
	case 'publish':
		$req=new DatabaseRequest("UPDATE sondage SET Publie='N'");
		$resultat=$req->Request();
		unset($req);
		if($resultat==true)
		{
			$sql = "UPDATE sondage SET Publie='Y'  WHERE Num =".$_POST['Num'];
		}
	break;
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
