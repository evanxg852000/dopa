<?php
include("../../system.admin.php");

$sql = "SELECT* From reponse where Num_so=3";
$req=new DatabaseRequest($sql);
$rep=$req->Select();
unset($req);
$nb_electeur=0;
$table_pourcentage=array();
print_r($rep);
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
echo '<br>';
print_r($table_pourcentage);
?>
