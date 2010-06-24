<?php
function S_DCreerCompte()
{
	Global $LANG,$DB_PREF;
	$contenu='<div class="article">'."\n"
			 .'<div class="entetearticle"><h2>'.$LANG['CreateAcompte'].'</h2></div><br>'."\n"
			.'<fieldset class="cadre_corps">'."\n"
			.'<FORM method="GET" action="index.php" name="signin"> '."\n"
			.'<p>'."\n"
			.'<label > *'.$LANG['Label_name'].' </label><br />'."\n"
			.'<input name="Nom_c" class="inputbox" type="text" >  </input>'."\n"
			.'</P>'."\n"
			.'<P>'."\n"
			.'<label > *'.$LANG['Login'].' </label><br />'."\n"
			.'<input name="L_c" class="inputbox" type="text" value="" > </input>'."\n"
			.'</P>'."\n"
			.'<P>'."\n"
			.'<label > *'.$LANG['Password'].' </label><br />'."\n"
			.'<input name="M_c" class="inputbox" type="password" value="" > </input>'."\n"
			.'</P>'."\n"
			.'<p>'."\n"
			.'<label > *'.$LANG['Label_mail'].' </label><br />'."\n"
			.'<input name="Mail_c" class="inputbox" type="text"  >  </input>'."\n"
			.'</P>'."\n"	
			.'<input type="button"  class="button"  onclick="verifie_creercompte(this.form)" value="'.$LANG['Label_send'].'"/>	'."\n" 
			.'<input type="hidden" name="option" value="action" />'."\n"
			.'<input type="hidden" name="composant" value="cct" />'."\n"
			.'</FORM>'."\n"
			.'</fieldset >'."\n"
			.'</div>'."\n";
	return $contenu;
}
?>