<?php
function DMenu($option)
{
	Global $DB_PREF ,$LANG,$JSWIDGETS;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="mainmenu" ;//ajout
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
	$sql='SELECT* FROM '.$DB_PREF.'article where Publie="Y"' ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	echo    '<div id="mainmenu" class="CollapsiblePanelGroup">'."\n";
	        echo  '<div class="CollapsiblePanel" >'."\n";
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Menuprincipal'].'</h3>'."\n"; 
							echo  '<div class="CollapsiblePanelContent">'."\n";
								echo  '<ul class="mainmenu">'."\n";
										for($i=0;$i<count($resultat);$i++)
										{
											echo  '<li id="elem.'.$i.'"> <a href="index.php?">'.$resultat[$i]['Nom'].'</a></li>'."\n";
										}
								echo  '</ul>'."\n";
							echo  '</div>'."\n";
			echo '</div>'."\n";
	echo '</div>'."\n";
}
?>