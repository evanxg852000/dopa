<?php
function S_DContact()
{
	Global $LANG,$DB_PREF,$ESTNAME,$FAX_ETS ,$TEL_ETS ,$EMAIL_ETS ,$ADRESSE_ETS;
	
	$contenu='<div class="article">'."\n"
			 .'<div class="entetearticle"><h2>'.$LANG['Title_contact'].'</h2></div>'."\n"
			 .'<p class="infos">'.$LANG['Info'].$resultat[0]['Info'].'</p>'."\n"
			 .'<P>'
			 .'<b>'.$LANG['Etsname'].'</b>'.$ESTNAME.'<br>'
			 .'<b>'.$LANG['Adresse'].'</b>'.$ADRESSE_ETS.'<br>'
			 .'<img src="media/icons/tel.png" style="border:1px" alt="Tel" title="Tel"></img>&nbsp; '.$TEL_ETS.'<br>'
			 .'<img src="media/icons/fax.png" style="border:1px" alt="Fax" title="Fax"></img>&nbsp; '.$FAX_ETS.'<br>'
			 .'<img src="media/icons/mail.png" style="border:1px" alt="E-mail" title="E-mail"></img>&nbsp; '.$EMAIL_ETS.'<br>'
			 .'</p>'."\n"
			 .'</div>'."\n"
//=================================================================		 
			.'<div class="article">'."\n"
				.'<div class="entetearticle"><h2>'.$LANG['Title_contact_us'].'</h2></div><br>'."\n"
				.'<fieldset class="cadre_corps">'."\n"
					.'<form method="GET" action="index.php" name="mail-form" >'."\n"
						.'<P>'."\n"
							.'<label >* '.$LANG['Label_name'].':</label><br />'."\n"
							.'<input type=text class="inputbox" name="Nom"> </input>'."\n"
						.'</p>'."\n"
						.'<P>'."\n"
							.'<label >* '.$LANG['Label_mail'].':</label><br />'."\n"
							.'<input type=text class="inputbox" name="Email"> </input>'."\n"
						.'</p>'."\n"
						.'<P>'."\n"
							.'<label >* '.$LANG['Label_subject'].':</label><br />'."\n"
							.'<input type=text class="inputbox" name="Objet"> </input>'."\n"
						.'</p>'."\n"
						.'<p>'."\n"
							.'<label >* '.$LANG['Label_content'].':</label><br />'."\n"
							.'<textarea class="inputbox" cols="45" rows="7" name="Content" ></textarea>'."\n"
						.'</p>'."\n"
							.'<input type="button" class="button" onclick="verifie_contact(this.form)" value="'.$LANG['Label_send'].'" > </input><br>'."\n"
							.'<input type="hidden" name="option" value="action" />'."\n"
							.'<input type="hidden" name="composant" value="mai" />'."\n"
					.'</form>'."\n"
				.'</fieldset>'."\n"
			.'</div>'."\n";
	return $contenu;
}
?>