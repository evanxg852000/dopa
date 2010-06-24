<?php
function S_DIndex() //cette fonction affiche tous les articles pubie en prmiere page
{
	Global $DB_PREF,$LANG;
	$contenu="";
	$sql="SELECT* FROM ".$DB_PREF."article where Publie='Y' AND Publie_ho='Y'";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	for($i=0;$i<count($resultat);$i++)
	{
		$contenu=$contenu.'<div class="article">'."\n"
						 .'<div class="entetearticle"><h2>'.$resultat[$i]['Nom'].'</h2></div>'."\n"
				         .'<p class="infos">'.$LANG['Info'].$resultat[$i]['Info'].'</p>'."\n"
				         .'<P>'.$resultat[$i]['Contenu'].'</p>'."\n"
		                 .'</div>'."\n";
	}
	return $contenu;
}
?>