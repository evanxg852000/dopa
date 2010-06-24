<?php
include('../system.admin.php');
session_start();
$pass_conet=$_SESSION['pass'] ;
$login_conet=$_SESSION['login']; 

$deconnexion=deconect_admin($login_conet,$pass_conet) ;

if ($deconnexion==true){
session_unset();
session_destroy();
header ('Location: index.php');
exit();
}
else
{
echo '<div class="mes_eror">Impossible de vous deconnecter</DIV>';
}
?>