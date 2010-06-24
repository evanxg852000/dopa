<?php
function DIdentification($option)
{
	Global $DB_PREF ,$LANG,$JSWIDGETS,$ISCONECTED ;;
	$i=count($JSWIDGETS);
	$JSWIDGETS[$i]['id']="identification" ;//ajout
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
	echo    '<div id="identification" class="CollapsiblePanelGroup">'."\n";
	        echo  '<div class="CollapsiblePanel" >'."\n";
						echo '<h3 class="CollapsiblePanelTab" >'.$LANG['Connexion'].'</h3>'."\n"; //sondages  lang
							echo  '<div class="CollapsiblePanelContent">'."\n";
									echo '<form method="GET" action="index.php"  name="connexion-form" id="connexion-form" >'."\n";
										echo '<fieldset class="cadre">'."\n";
											echo '<p id="login-form">'."\n";
												echo '<label for="login">'.$LANG['Login'].'</label><br />'."\n";
												echo '<input id="login" type="text" name="login" class="inputbox" alt="'.$LANG['Login'].'" size="18" />'."\n";
											echo '</p>'."\n";
											echo '<p id="motpass-form">'."\n";
												echo '<label for="motpass">'.$LANG['Password'].'</label><br />'."\n";
												echo '<input id="motpass" type="password" name="motpass" class="inputbox" size="18" alt="'.$LANG['Password'].'" />'."\n";
											echo '</p>'."\n";
												echo '<p id="rapel-form">'."\n";
												echo '<label for="rapel">'.$LANG['Remember'].'</label>'."\n";
												echo '<input id="rapel" type="checkbox" name="rapel" class="inputbox" value="oui" alt="'.$LANG['Remember'].'" />'."\n";
											echo '</p>'."\n";
												echo '<input type="submit"  class="button" value="Connexion" />';
										echo '</fieldset>'."\n";
										echo '<ul>'."\n";
											echo '<li><a href="index.php?option=view&composant=cob">'.$LANG['Forgoten'].'</a></li>'."\n";
											echo '<li><a href="index.php?option=view&composant=cct">'.$LANG['CreateAcompte'].'</a></li>'."\n";
											if($ISCONECTED)
											{
												echo '<li><a href="index.php?option=action&composant=dcx">'.$LANG['Deconnexion'].'</a></li>'."\n";
											}
										echo '</ul>'."\n";
										echo '<input type="hidden" name="option" value="action" />'."\n";
										echo '<input type="hidden" name="composant" value="cnx" />'."\n";
									echo '</form>'."\n";
							echo  '</div>'."\n";
			echo '</div>'."\n";
	echo '</div>'."\n";	
}
?>