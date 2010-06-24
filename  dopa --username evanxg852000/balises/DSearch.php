<?php
function DCherche()
{
	Global $LANG;
	$anim=$LANG['searchbox'];
					echo	'<form action="index.php" method="GET">'."\n";
								echo'<input name="motcle" id="mod_search_searchword" maxlength="20" alt="Search" class="inputbox" type="text" size="20" value="'.$anim.'"  onblur="if(this.value==\' \') this.value=\''.$anim.'\';" onfocus="if(this.value==\''.$anim.'\') this.value=\' \';" />'."\n"; 						
								echo '<input type="hidden" name="option" value="action" />'."\n";
								echo '<input type="hidden" name="composant" value="che" />'."\n";
					echo	'</form>'."\n";
}
?>