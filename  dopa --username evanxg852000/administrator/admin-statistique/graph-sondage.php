<?php
include("../../system.admin.php");
$sql = "SELECT* From ".$DB_PREF."Sondage where Publie='Y'";
$req=new DatabaseRequest($sql);
$resultat1=$req->Select();
unset($req);

//===============================================recuperation des donnes 
$sql = "SELECT* From ".$DB_PREF."reponse where Num_so=".$resultat1[0]['Num'];
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
	$table_pourcentage[$i]['value']=$rep[$i]['Nb_vote']*100/$nb_electeur;
}

$donnee=$table_pourcentage;

//===========================================fin recuperation donne

//affiche seulement le graph
$graph=new Graph('sondage.png','affchage.png',$donnee,'-a');
$graph->Dessine();
?>