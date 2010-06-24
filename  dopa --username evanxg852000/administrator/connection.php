<?php
include('../system.admin.php');
// on teste si le visiteur a soumis le formulaire de connexion
$bloque=controleur_admin();
if(!$bloque)
{
	if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
		if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) 
		{
			$login_admin=mysql_escape_string($_POST['login']);
			//cryptage
			$m=new MotCrypte(mysql_escape_string($_POST['pass']),"m");
			$mot_pass=$m->Crypter();
			unset($m);
			$connexion=conect_admin($login_admin ,$mot_pass) ;
			//for test
			//$connexion=true;
			if ($connexion==true) 
			{
				session_start();
				$_SESSION['login'] = $login_admin;
				$_SESSION['pass'] = $mot_pass;
				header("Location: home.php");
				 exit();
			}
			else // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login,soit dans son mot de passe
			{	 
				echo '<div class="mes_eror">Compte non reconnu ou ce compte est deja connecte</DIV>';
			}
		}
	}
}
else
{
 header('Location: ../forbiden.php');
}
?>	