<?php
include("../../system.admin.php");
$type_expediteur=$_POST['Expediteur'];
Switch ($type_expediteur){
	Case 'Admin':
		$email_exp=$EMAIL_ADMIN;
		$name="Admin";
	Break;
	Case 'Automate':
		$email_exp="robot@robot.fr";
		$name="Automate";
	Break;
}
$objet="Message du site ".$SITENAME;

$email_dest=$_POST['Destinataire'];
$contenu=$_POST['contenu_message'];

//send_mail() envoi un mail externe a partir de admin
//wrtie_us() enregistre un message dans message interne

$test=send_mail($email_exp,$email_dest, $name, $objet, $contenu);
		If ($test==true) {
			echo '{success:true, msg:'.json_encode('message envoyer').'}';
		}else{
			
			echo '{success:true, msg:'.json_encode('Echeque d\'envoi du message').'}';
		}
		
?>
