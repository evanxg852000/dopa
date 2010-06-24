<?php
include("../../system.admin.php");
$sql = "SELECT* From Sondage where Publie='Y'";
$req=new DatabaseRequest($sql);
$resultat=$req->Select();
unset($req);
echo '<div class="x-panel-mc" style="height:243px;"><div style="height:243px;"class="x-panel-body">';
echo '<div id="lay2" style="background: Silver;width:200px; height:104px; position:absolute; left:0px; top:102px; z-index:1;">
			<p>sondage</p>
			<p><a href="stats-view.php">voire les statistiques  en gros plan</a></p>
	  </div>
	  <div id="lay1" style="background: Silver;width:200px; height:99px; position:absolute; left:0px; top:0px; z-index:1;">
			<p>Affluence</p>
			<P>Connectes: 55</P>
			<P>Nb Hits: 345</P>
	  </div>
      <div id="lay3" style="width:155px; height:206px; position:absolute; left:201px; top:0px; z-index:1;">';
  if( file_exists($resultat[0]['Nom'].'.png'))
	{
	 echo '<img src="admin-statistique/'.$resultat[0]['Nom'].'.png" style="border:0px; width:155px; height:206px;" > </div>';
	}		
	else
	{
				echo '<img src="admin-statistique/graph-sondage.php" style="border:0px; width:155px; height:206px;" > </div>';
				
	}

echo '</div></div>';

?>
