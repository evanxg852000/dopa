<?php
function DNewsletter()
{
	Global $LANG;
	$anim=$LANG['newsletter'];
	echo '<FORM action="index.php?option=action&composant=newsletter" method="post">'."\n";
			echo'<input name="Email_nl" class="inputbox" type="text"  value="'.$anim.'"  onfocus="if (this.value ==\''.$anim.'\') { this.value=\'\' }" onblur="if (this.value==\'\') {this.value=\''.$anim.'\'}">   </input>'."\n"; 	
			//echo '<INPUT  type="submit" class="button" alt="entrer" value="'.$LANG['enter_bt'].'">'; 
	echo '</FORM>'."\n";				
}
/*exple
	<div id="newsletter">
		DNewsletter()
	</div>
*/
?>