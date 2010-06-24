<?php
function DExtentions($option)
{
   Global $DB_PREF ,$LANG,$JSWIDGETS;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="extentions" ;//ajout
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
	$sql=" SELECT* FROM ".$DB_PREF."plugins where Publie='Y'";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	echo    '<div id="extentions" class="CollapsiblePanelGroup">';
	        echo  '<div class="CollapsiblePanel" >';
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Extentions'].'</h3>'; //extentions lang
							echo  '<div class="CollapsiblePanelContent">';
								echo  '<ul class="extentions">';
										for($i=0;$i<count($resultat);$i++)
										{
											echo  '<li id="elem.'.$i.'"> <a href="plugins/'.$resultat[$i]['Lien'].'/index.php" target="_blank">'.$resultat[$i]['Nom'].'</a></li>';
										}
								echo  '</ul>';
							echo  '</div>';
			echo '</div>';
	echo '</div>';
}
?>
