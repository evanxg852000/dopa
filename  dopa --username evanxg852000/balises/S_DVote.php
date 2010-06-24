<?php
function S_DVote($num_sondage,$reponse)
{
	Global $DB_PREF, $LANG;
	$sql = "UPDATE ".$DB_PREF."reponse SET Nb_vote=Nb_vote+1 WHERE Reponse='".$reponse."' AND Num_so=".$num_sondage;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Request();	
	unset($req);
	if($resultat)
	{
		$contenu='<div class="mes_info">'.$LANG['VoteSaved'].'</DIV>'
				 .'<A href="index.php?option=view&composant=rvo" >'.$LANG['Resultat'].'</A>'."\n";
	}
	else
	{
		$contenu='<div class="mes_eror">'.$LANG['VoteFailled'].'</DIV>'
			     .'<A href="index.php?option=view&composant=rvo" >'.$LANG['Resultat'].'</A>'."\n";
	}
	return $contenu;
}
?>