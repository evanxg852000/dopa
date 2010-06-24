<?php
include("../../system.admin.php");
$sql = "SELECT* From Sondage where Publie='Y'";
$req=new DatabaseRequest($sql);
$resultat=$req->Select();
unset($req);

      
				echo '<img src="graph-sondage-grand.php"  >';



?>
