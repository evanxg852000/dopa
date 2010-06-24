<?php
function S_DResultatSearch($motcle)
{
	Global $LANG,$DB_PREF;
	$keyword=clean($motcle);
	$sql="SELECT* FROM ".$DB_PREF."article where Contenu LIKE '%$keyword%' and Publie='Y'" ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	$contenu='<div class="article">'."\n"
			 .'<div class="entetearticle"><h2>'.$LANG['Searchresult'].'</h2></div>'."\n";
	for($i=0;$i<count($resultat);$i++)
	{
		$ilustration = explode(".",$resultat[$i]['Contenu']);
		$contenu=$contenu.'<P><h4 class="titlesearch">'.$i+1 .': '.$resultat[$i]['Nom'].'</h4><br>'
		.'<font class="detailssearch">'.$ilustration[0].'.</font><br>'	
		.'<A href="index.php?option=view&composant=art&id='.$resultat[$i]['Num'].'" style="float:rigth">'.$LANG['SearchDetails'].'</A>'."\n"
		.'</p>'."\n"	;
	}
	if(count($resultat)<=0)
	{
			$contenu=$contenu.'<br><div class="mes_info">'.$LANG['SearchNotMacth'].'</DIV>';
	}
	$contenu=$contenu.'<br><A href="http://google.fr/index.php? '.$keyword.'">'.$LANG['SearchGoogle'].'</A>'."\n".'</div>'."\n";
	return $contenu;
}
?>