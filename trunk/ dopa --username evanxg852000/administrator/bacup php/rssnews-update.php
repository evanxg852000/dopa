<?php
Include('library.php');

	$action  = $_POST['action'];

Switch ($action){
	Case 'update':
		$sql = "UPDATE rssnews SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num = ".$_POST['Num'];
	Break;
	Case 'insert':
			$sql = "INSERT INTO rssnews (Num,Titre,Lien,Description,Date) VALUES ( ".$_POST['Num'].",'".$_POST['Titre']."','',0,'')";
	Break;
	Case 'delete':
		$sql = "DELETE FROM rssnews WHERE Num = ".$_POST['Num'];
	Break;
}
  $test=exereq($sql);

If ($test==true) {
	
		Echo '{success:true}';
}else{
	
	Echo '{success:false}';	
}

?>
