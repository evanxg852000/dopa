<?php
function DPublicite($option)
{
	Global $DB_PREF ,$LANG,$JSWIDGETS;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="publicite" ;//ajout
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
	$sql=" SELECT* FROM ".$DB_PREF."publicite where Publie='Y'";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	echo    '<div id="publicite" class="CollapsiblePanelGroup">'."\n";
	        echo  '<div class="CollapsiblePanel" >'."\n";
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Publicite'].'</h3>'."\n"; 
							echo  '<div class="CollapsiblePanelContent">'."\n";
								for($i=0;$i<count($resultat);$i++)
								{
									echo '<div class="elempub"><a href="'.$resultat[$i]['Lien'].'" target="_blank">'.$resultat[$i]['Titre'].'</a>'."\n";
										echo '<br/>'."\n";
										echo $resultat[$i]['Description'].'<div class="vide"></div>'."\n";
									echo '</div>'."\n";
								}
							echo  '</div>'."\n";
			echo '</div>'."\n";
	echo '</div>'."\n";	
}
?>