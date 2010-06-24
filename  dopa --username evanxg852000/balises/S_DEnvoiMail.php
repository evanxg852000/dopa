<?php
function S_DEnvoiMail($nom,$mail,$objet,$message)
{
	Global $LANG ,$EMAIL_ETS,$EMAIL_ADMIN;
	$mail_dest=$EMAIL_ADMIN.','.$EMAIL_ETS ;
	$nom_c=clean($nom);
	$mail_c=clean($mail);
	$objet_c=clean($objet);
	$message_c=clean($message);
	$mon_mail=new Mail($nom_c,$mail_c,$mail_dest,'text');
	$test=$mon_mail->send($objet_c,$message_c);
	unset($mon_mail);
	if($test)
	{
		$contenu='<div class="mes_info">'.$LANG['MailSended'].$mail_dest.'</DIV>';
	}
	else
	{
		$contenu='<div class="mes_eror">'.$LANG['MailFailled'].'</DIV>';
	}
	return $contenu;
}
?>