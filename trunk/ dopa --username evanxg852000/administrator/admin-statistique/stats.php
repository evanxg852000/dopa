<?php
include("../../system.admin.php");
$sql = "SELECT* From ".$DB_PREF."Sondage where Publie='Y'";
$req=new DatabaseRequest($sql);
$resultat=$req->Select();
unset($req);

echo '<div class="x-panel-mc" style="width:363px;height:243px;"><div style="width:363px;height:243px;"class="x-panel-body">';
echo '<img src="admin-statistique/graph-sondage.php" style="border:0px; width:363px; height:216px;" > </div>';
echo '</div></div>';
?>