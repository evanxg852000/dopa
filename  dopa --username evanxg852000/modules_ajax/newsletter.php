<?php
function newsletter()
{
	Global $LANG;
	$anim=$LANG['newsletter'];

		echo '<div class="module" >';
				echo '<div class="newsletter">';	
								echo '<FORM action="index.php?option=newsletter&title" method="post">';
											echo'<input name="Email_nl" class="inputbox" type="text"  value="'.$anim.'"  onfocus="if (this.value ==\''.$anim.'\') { this.value=\'\' }" onblur="if (this.value==\'\') {this.value=\''.$anim.'\'}">    </input>'; 	
											echo '<INPUT  type="submit" class="button" alt="entrer" value="'.$LANG['enter_bt'].'">'; 
								echo '</FORM>';	
				echo '</div>';							
		echo '</div>';
	
	
}
?>