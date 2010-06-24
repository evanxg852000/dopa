<?php
function S_DCategorie($num)
{
	Global $DB_PREF,$LANG;
	$contenu="";
	$sql='SELECT* FROM '.$DB_PREF.'article where Num_ca='.$num ;
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