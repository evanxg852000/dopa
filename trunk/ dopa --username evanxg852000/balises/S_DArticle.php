<?php
function S_DArticle($num)
{
	Global $DB_PREF, $LANG;
	$contenu="";
	$sql="SELECT* FROM ".$DB_PREF."article where Num=".$num ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	$contenu='<div class="article">'."\n"
			 .'<div class="entetearticle"><h2>'.$resultat[0]['Nom'].'</h2></div>'."\n"
			 .'<p class="infos">'.$LANG['Info'].$resultat[0]['Info'].'</p>'."\n"
			 .'<P>'.$resultat[0]['Contenu'].'</p>'."\n"
			 .'</div>'."\n";
	return $contenu;
}
?>