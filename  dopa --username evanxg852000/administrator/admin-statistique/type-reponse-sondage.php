<?php
include("../../system.admin.php");
if (!isset($_REQUEST['Numero']))
{

}
else
{
$sql = 'SELECT* From '.$DB_PREF.'reponse where Num_so='.$_REQUEST['Numero'];
$req=new DatabaseRequest($sql);
$resultat=$req->SelectJson();
echo $resultat;
unset($req);
}
?>