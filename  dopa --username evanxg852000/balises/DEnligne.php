<?php
function DCompteur()
{
	Global $LANG,$DB_PREF ;
		$sql= "SELECT* FROM ".$DB_PREF."compteur where Etat='N'"; //on selectione tous les visiteurs qui ne sont pas bloque
  		$req=new DatabaseRequest($sql);
		$resultat=$req->Select();	
		unset($req);
		echo $LANG['connecte'].count($resultat);
}

function DAdminEnligne() //affiche si l'admin est en ligne    <B class=cli_d>DESACTIVE</B>
{
	Global $LANG,$DB_PREF ;
		$sql='SELECT* FROM '.$DB_PREF.'utilisateur WHERE Etat="Y"' ;
	  	$req=new DatabaseRequest($sql);
		$resultat=$req->Select();	
		unset($req);
    	$nb_ligne =count($resultat);
	if ($nb_ligne !=0)
	{
		echo $LANG['admin_state'].' : <B class=online>'.$LANG['activate'].'</B><br><br>';
		for($i=0;$i<$nb_ligne;$i++) 
		   {
			echo $resultat[$i]['Nom'].' '.$LANG['admin_online'];	
		   }
		   //echo "<br><a href='chat.php' target='_blank'><B>ENTRER EN CONTACT</B></a>";
	}
	else
	{
	echo  $LANG['admin_state'].' : <B class=offline>'.$LANG['desactivate'].'</B>';
	}		     
}

function DEligne($option)
{
	Global $DB_PREF ,$LANG,$JSWIDGETS;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="enligne" ;//ajout
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
	echo    '<div id="enligne" class="CollapsiblePanelGroup">';
	        echo  '<div class="CollapsiblePanel" >';
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Enligne'].'</h3>'; 
							echo  '<div class="CollapsiblePanelContent">';
									DCompteur();
									echo '<br>';
									DAdminEnligne();
									echo '<br>';
									DRss();
							echo  '</div>';
			echo '</div>';
	echo '</div>';	
}
/*exple
	<div id="enligne">
		<?php DCompteur() ?>
		<?php DAdminEnligne() ?>
	</div>
	<?php DEligne(true) ?>
*/
?>