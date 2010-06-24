<?php
function S_DConnexion()
{
	Global $ISCONECTED ;
	if ((isset($_GET['login']) && !empty($_GET['login'])) && (isset($_GET['motpass']) && !empty($_GET['motpass']))) 
		{
			$login=mysql_escape_string($_GET['login']);
			//decryptage
			$m=new MotCrypte(mysql_escape_string($_GET['motpass']),"m");
			$motpass=$m->Decrypter();
			unset($m);

			$connexion=conect_user($login ,$motpass) ;
			if ($connexion==true) 
			{
				$_SESSION['ISCONECTED']=true;
				$ISCONECTED=true;
				$_SESSION['LOGIN'] = $login;
				$_SESSION['MOTPASS'] = $motpass;
				return "vous etes conecte ".$_SESSION['LOGIN'];
			}
			else 
			{	
				$_SESSION['ISCONECTED'] =false;
				$ISCONECTED=false;
				return "Compte non reconnu ou ce compte est deja connecte";
			}
		}
}
?>