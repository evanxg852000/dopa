<?php
function S_DCreerCompteConfirm()
{
	Global $LANG,$DB_PREF;
	$nom=mysql_escape_string($_GET['Nom_c']);
	$login=mysql_escape_string($_GET['L_c']);
	$mail=mysql_escape_string($_GET['Mail_c']);
	//cryptage
	$m=new MotCrypte(mysql_escape_string($_GET['M_c']),"m");
	$motpass=$m->Crypter();
	unset($m);
	
	$sql="SELECT* FROM ".$DB_PREF."utilisateur where Login='".$login."'" ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	$n=count($resultat);
	unset($req);
	
	if($n>0)
	{
		return $LANG['Login_Taken'];
	}
	else
	{
		$sql="INSERT INTO ".$DB_PREF."utilisateur(Num, Mot_pass, Nom, Login, Fonction, Niv_acces, Mail, Etat) VALUES (NULL ,'".$motpass."','".$nom."','".$login."','invite',NULL,'".$mail."','N')"; 
		$req=new DatabaseRequest($sql);
		$resultat=$req->Request();	
		unset($req);
		if($resultat)
		{
			return $LANG['Sign_In_Succes'];
		}
		else
		{
			return $LANG['Sign_In_Fail'];
		}
	}
}
?>