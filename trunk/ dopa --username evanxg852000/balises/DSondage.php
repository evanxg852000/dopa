<?php
function DSondage($option)
{
	Global $DB_PREF ,$LANG,$JSWIDGETS;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="sondage" ;//ajout
	switch ($option)
	{
		case 1:
			$JSWIDGETS[$i]['config']="{contentIsOpen:true, enableAnimation:true}"; //ouver et anime
			break;
		case 2:
			$JSWIDGETS[$i]['config']="{contentIsOpen:false, enableAnimation:true}"; //ferme et anime
			break;
		case 3:
			$JSWIDGETS[$i]['config']="{contentIsOpen:true, enableAnimation:false}"; //ouvert non anime
			break;		
	}	
	$sql=" SELECT* FROM ".$DB_PREF."sondage where Publie='Y'";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	
	$sql=" SELECT* FROM ".$DB_PREF."reponse where Num_so=".$resultat[0]['Num'];
	$req=new DatabaseRequest($sql);
	$resultat_rep_sondage=$req->Select();	
	unset($req);
	
	echo    '<div id="sondage" class="CollapsiblePanelGroup">'."\n";
	        echo  '<div class="CollapsiblePanel" >'."\n";
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Sondage'].'</h3>'."\n"; //sondages  lang
							echo  '<div class="CollapsiblePanelContent">'."\n";
										echo '<form action="index.php" method="GET" name="sondageform">'."\n";
												echo '<table width="95%" border="0" cellspacing="0" cellpadding="1" align="center" class="sondage">'."\n";
														echo '<thead>'."\n";
																echo '<tr>'."\n";
																	echo '<td style="font-weight: bold;">'.$resultat[0]['Question'].'</td>'."\n";
																echo '</tr>'."\n";
														echo '</thead>'."\n";
														echo '<tr>'."\n";
																echo '<td align="center">'."\n";
																				echo '<table  cellspacing="0" cellpadding="0" border="0">'."\n";
																							for ($i=0;$i<count($resultat_rep_sondage);$i++)
																							{
																								echo '<tr>'."\n";
																										echo '<td  valign="top">'."\n";
																											echo '<input type="radio" name="sondage_reponse" id="sondagerep_'.$i.'" value="'.$resultat_rep_sondage[$i]['Reponse'].'" alt="reponse" />'."\n";
																										echo '</td>'."\n";
																										echo '<td  valign="top">'."\n";
																											echo '<label for="sondagerep_'.$i.'">'.$resultat_rep_sondage[$i]['Reponse'].'</label>'."\n";
																										echo '</td>'."\n";
																								echo '</tr>'."\n";
																							}
																				echo '</table>'."\n";
																echo '</td>'."\n";
														echo '</tr>'."\n";
														echo '<tr>'."\n";
																echo '<td>';
																	echo '<div align="center">'."\n";
																		echo '<input type="hidden" name="num_so" value="'.$resultat[0]['Num'].'" />'."\n";
																		echo '<input type="hidden" name="option" value="action" />'."\n";
																		echo '<input type="hidden" name="composant" value="vot" />'."\n";
																		echo '<input type="submit"  class="button" value="'.$LANG['Vote'].'" />'."\n";
																		echo '<input type="button" name="option" class="button" value="'.$LANG['Resultat'].'" onclick="document.location.href=\'index.php?option=view&composant=rvo\'" />'."\n";
																	echo '</div>'."\n";
																echo '</td>'."\n";
														echo '</tr>'."\n";
														echo '</table>'."\n";
														echo '</form>'."\n";
							echo  '</div>'."\n";
			echo '</div>'."\n";
	echo '</div>'."\n";	
}
?>