<?php
function S_DCompteOublieConfirm()
{
	Global $LANG,$DB_PREF;
	$contenu="";
	$nom=mysql_escape_string($_GET['Nom']);
	$mail=mysql_escape_string($_GET['Mail']);
	
	$sql="SELECT* FROM ".$DB_PREF."utilisateur where Nom='".$nom."' AND Mail='".$mail."'" ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	$n=count($resultat);
	unset($req);
	
	if($n<=0)
	{
		return $LANG['Unknown_user'];
	}
	else
	{
		$login=$resultat[0]['Login'];
		$Motpass=time();
		$m=new MotCrypte($Motpass,"m");
		$Motpass_crypte=$m->Crypter();
		
		$sql="UPDATE ".$DB_PREF."utilisateur SET Mot_pass='".$Motpass_crypte."' where Nom='".$nom."' AND Mail='".$mail."'" ;
		$req=new DatabaseRequest($sql);
		$test=$req->Request();	
		unset($req);
		if($test)
		{
				$message=$LANG['Login'].":".$login."\n"
							.$LANG['Password'].":".$Motpass."\n";
				$mon_mail=new Mail('nobody',$mail_c,$mail,'text');
				$test=$mon_mail->send('Your Iformations',$message);
				unset($mon_mail);
				if($test)
				{
					$contenu='<div class="mes_info">'.$LANG['InfoSended'].'</DIV>';
				}
				else
				{
					$contenu='<div class="mes_eror">'.$LANG['InfoFailled'].'</DIV>';
				}
		}
		else
		{
			$contenu='<div class="mes_eror">'.$LANG['InfoFailled'].'</DIV>';
		}
		return $contenu;
	}
}
?>