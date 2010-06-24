<?php
function S_DDeconnexion()
{
	Global $ISCONECTED ;
	$_SESSION['ISCONECTED'] =false;
	$ISCONECTED=false;
	return 'vous avez ete deconnecte';
}
?>