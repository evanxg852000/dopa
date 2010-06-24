<?php
include('../kernel/configuration.php');
session_start();
$pass_conet=$_SESSION['pass'] ;
mysql_connect( $SERVER ,$USERNAME , $PASSSQL) or die('connexion impossible') ;
mysql_select_db($DBNAME) or die('Base inexistante');
$sql = 'UPDATE utilisateur SET Etat="N"  WHERE Mot_pass="'.$pass_conet.'"';
mysql_query($sql)or die('erreur de requete');
mysql_close() ;
session_start();
session_unset();
session_destroy();

header ('Location: index.php');
exit();
?>
