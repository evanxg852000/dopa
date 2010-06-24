<?php
include('../admin_library.php');
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) 
{
	
$req='SELECT* FROM utilisateur WHERE login="'.mysql_escape_string($_POST['login']).'" AND Mot_pass="'.mysql_escape_string($_POST['pass']).'"';	
mysql_connect( 'localhost' ,'root' , '') or die('connexion impossible') ;
mysql_select_db("dopa") or die('Base inexistante');
$query = mysql_query($req) or die( 'Erreur d\'execution de la requette' );
 $nb_ligne = mysql_num_rows($query);
// si on obtient une réponse, alors l'utilisateur est un membre
if ($nb_ligne!=0) {
session_start();
$_SESSION['login'] = $_POST['login'];
$_SESSION['pass'] = $_POST['pass'];
//on enregistre la connection dans utilisateur
$sql = 'UPDATE utilisateur SET Etat="Y"  WHERE Mot_pass="'.$_POST['pass'].'"';
mysql_query($sql)or die('erreur de requete');
mysql_close() ;
//$page=$SKINADMIN.'/home.php';
header("Location: home.php");
 exit();
}
// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login,soit dans son mot de passe
else 
{
echo '<div class="mes_eror">Compte non reconnu</DIV>';
}

}
}

?>	


