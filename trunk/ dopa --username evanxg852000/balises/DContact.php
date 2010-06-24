<?php
function DContact()
{
	Global $LANG,$ESTNAME,$FAX_ETS,$TEL_ETS,$EMAIL_ETS,$ADRESSE_ETS;
	echo '<div class="article">'."\n";
		echo '<div class="entetearticle"><h2>'.$LANG['Title_contact'].'</h2></div>'."\n";
			echo '<P>'."\n";
				echo '<b>Tel : '.$TEL_ETS.'</b><br>'."\n";
				echo '<b>Mail : '.$EMAIL_ETS.'</b><br>'."\n";
				echo '<b>Fax : '.$FAX_ETS.'</b><br>'."\n";
				echo '<b>Adresse : '.$ADRESSE_ETS.'</b><br>'."\n";
			echo '</P>'."\n";
		echo '<fieldset class="inputbox">'."\n";
			echo '<form method="post" name="mail-form" action="index.php?option=action&composant=contact" >'."\n";
					echo '<P>'."\n";
						echo '<label >* '.$LANG['Label_name'].':</label><br />'."\n";
						echo '<input type=text class="inputbox" name="Nom"> </input>'."\n";
					echo '</p>'."\n";
					echo '<P>'."\n";
						echo '<label >* '.$LANG['Label_mail'].':</label><br />'."\n";
						echo '<input type=text class="inputbox" name="Email"> </input>'."\n";
					echo '</p>'."\n";
					echo '<P>'."\n";
						echo '<label >* '.$LANG['Label_subject'].':</label><br />'."\n";
						echo '<input type=text class="inputbox" name="Objet"> </input>'."\n";
					echo '</p>'."\n";
					echo '<p>'."\n";
						echo '<label >* '.$LANG['Label_content'].':</label><br />'."\n";
						echo '<textarea cols="45" rows="7" name="Content" ></textarea>'."\n";
					echo '</p>'."\n";
						echo '<input type="button" class="button" onclick="verifie_contact(this.form)" value="'.$LANG['Label_send'].'" > </input><br>'."\n";
			echo '</form>'."\n";
		echo '</fieldset>'."\n";
	echo '</div>'."\n";
	
}
?>