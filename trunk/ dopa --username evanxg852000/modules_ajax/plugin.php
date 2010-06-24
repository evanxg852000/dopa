<?php
function plugin()
{
   Global $LANG;
   
   $req=" SELECT* FROM plugin where Etat=1";
		$result=select_rec ( $req ) ;
		$nb_ligne = mysql_num_rows($result);
		
		echo '<div id="CollapsiblePanelGroup1" class="CollapsiblePanelGroup">';
		echo '<div class="CollapsiblePanel">';
		echo '<h3 class="CollapsiblePanelTab"  id="plugin" >'.$LANG['plugin'].'</h3>';
		echo '<div class="CollapsiblePanelContent">';
		echo '<table  border="0" cellpadding="0" cellspacing="0">';
		while ( $list = mysql_fetch_array( $result) ) 
		{
			//echo '<tr align="left"><td><a href="plugins/'.$list['Lien'].'" class="mainlevel" target="_blank">'.$list['Nom'].'</a></td></tr>';
			echo '<tr align="left"><td><a href="" onclick="window.open(\'plugins/'.$list['Lien'].'\', \'new\', \'width=650,height=550,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no\');" class="mainlevel" >'.$list['Nom'].'</a></td></tr>';
		}	  
   echo '</table>';
   echo '</div>';
   echo '</div>';
   echo '</div>';
}
?>
