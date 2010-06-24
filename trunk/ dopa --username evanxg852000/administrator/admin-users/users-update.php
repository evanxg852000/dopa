<?php
include("../../system.admin.php");
session_start();
$pass_conet=$_SESSION['pass'] ;
$login_conet=$_SESSION['login']; 
$action  = $_POST['action'];

Switch ($action){
		Case 'update': //ne peut effectuer que des mise a jour sur son compte
			if($_POST['field']=='Mot_pass')
			{
				$m=new MotCrypte($_POST['value'],"m");
				$value=$m->Crypter();
				unset($m);
				$sql = "UPDATE ".$DB_PREF."utilisateur SET ".$_POST['field']." = '".$value."' WHERE Num =".$_POST['Num'];
			}
			else
			{
				$sql = "UPDATE ".$DB_PREF."utilisateur SET ".$_POST['field']." = '".$_POST['value']."' WHERE Num =".$_POST['Num'];
			}
				$req=new DatabaseRequest($sql);
				$resultat=$req->Request();	
				unset($req);
				If ($resultat==true) {	
						Echo 'Ces nouvelles valeurs sont desormains les seule valables';
				}else{
					
					Echo '{success:false}';	
				}
		Break;
		Case 'insert':
				$sql = "INSERT INTO ".$DB_PREF."utilisateur(Num, Mot_pass, Nom, Login, Fonction, Niv_acces, Mail, Etat) VALUES (NULL ,'undefined','".$_POST['Nom']."','unknow_user','admin','Simple_admin','undef@undef.com','N')";
				$req=new DatabaseRequest($sql);
				$resultat=$req->Request();	
				unset($req);
				If ($resultat==true) {	
						Echo 'ajout effectue';
				}else{
					
					Echo 'Erreur d\'execution de la requete';	
				}
		Break;
		Case 'delete':
				$sql = "DELETE FROM ".$DB_PREF."utilisateur WHERE Num = ".$_POST['Num']; 
				$req=new DatabaseRequest($sql);
				$resultat=$req->Request();	
				unset($req);		
				If ($resultat==true) {	
						Echo 'Suppresion effectue';
				}else{
					
					Echo 'Erreur d\'execution de la requete';	
				}
		Break;
	}
?>