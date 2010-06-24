<?php
function S_DResutatVote()
{
	Global $DB_PREF, $LANG;
	$sql = "SELECT* From Sondage where Publie='Y'";
	$req=new DatabaseRequest($sql);
	$resultat1=$req->Select();
	unset($req);

	//recuperation des donnes 
	$sql = "SELECT* From reponse where Num_so=".$resultat1[0]['Num'];
	$req=new DatabaseRequest($sql);
	$rep=$req->Select();
	unset($req);
	$nb_electeur=0;
	$table_pourcentage=array();
	for($i=0;$i<count($rep);$i++)
	{
		$nb_electeur=$nb_electeur+$rep[$i]['Nb_vote'];
	}
	//on remplie le tableau de pourcentage
	for($i=0;$i<count($rep);$i++)
	{
		$t=$rep[$i]['Reponse'];
		$table_pourcentage[$i]['label']=$t;
		$table_pourcentage[$i]['value']=Arrondir($rep[$i]['Nb_vote']*100/$nb_electeur,2);
	}
	

	$titre_sondage=$resultat1[0]['Question'];
	$nb_colone=count($table_pourcentage);
	
	//affichage graph au format html
	$contenu='<table  cellspacing="1" width="400" cellpadding="2" border="0">'
			.'<thead>'
			.'<tr>'
			.'<th colspan="'.$nb_colone.'" ><img src="media/icons/sondage.png"></img>'.$titre_sondage.' - ['.$nb_electeur.' '.$LANG['Electeur'].']</th>'
			.'</tr>'
			.'</thead>'
			.'<tbody>'
			.'<tr class="graphics" >';
			$j=1;//compteur des couleurs
			for($i=0;$i<$nb_colone;$i++){
				$contenu=$contenu.'<td align="center" valign="bottom" height="100">'
								 .'<div class="couleur_'.$j.'" style="height:'.$table_pourcentage[$i]['value'].'%;width:10px"></div>'
								 .'</td>';
				if($j==8){$j=1;}
				$j++;
			}
			
			$contenu=$contenu.'</tr>'
							  .'<tr class="label">';
			
			for($i=0;$i<$nb_colone;$i++){
				$contenu=$contenu.'<td align="center" valign="bottom">'.$table_pourcentage[$i]['label'].'  '.$table_pourcentage[$i]['value'].'%</td>';
			}
				
			$contenu=$contenu.'</tr>'
			.'</tbody>'
			.'</table>';
	return $contenu;
}
?>