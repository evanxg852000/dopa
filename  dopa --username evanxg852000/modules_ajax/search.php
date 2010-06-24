<?php
function search()
{
	Global $LANG;
	$anim=$LANG['searchbox'];

		echo '<div id="search" style="width:200px;">';
				echo '<div class="module">';
					echo '<div>';
						echo '<div>';
							echo '<div>';
								echo	'<form action="index.php?option=cherche&title" method="post">';
										echo '<div class="searchbox">';
											echo'<input name="mot_cle" id="mod_search_searchword" maxlength="20" alt="Search" class="inputbox" type="text" size="20" value="'.$anim.'"  onblur="if(this.value==\' \') this.value=\''.$anim.'\';" onfocus="if(this.value==\''.$anim.'\') this.value=\' \';" />'; 	
										
										echo '</div>';							
								echo	'</form>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
		echo '</div>';
      
}
?>