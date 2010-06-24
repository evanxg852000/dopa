<?php
function compteur()
{
	Global $LANG ;
//comptage final ...
  $req = "SELECT* FROM compteur where Etat='N'"; //on selectione tous les visiteurs qui ne sont pas bloque
  $result=select_rec ( $req ) ;
  $nb= mysql_num_rows($result);
  echo $LANG['connecte'].$nb;
}

?>