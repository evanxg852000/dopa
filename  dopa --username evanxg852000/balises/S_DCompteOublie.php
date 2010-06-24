<?php
function S_DCompteOublie()
{
	Global $LANG,$DB_PREF;
	$contenu="";
	$contenu='<div class="article">'."\n"
			 .'<div class="entetearticle"><h2>'.$LANG['Forgoten'].'</h2></div><br>'."\n"
			.'<fieldset class="cadre_corps">'."\n"
			.'<FORM method="GET" action="index.php" name="forgetacoumt"> '."\n"
			.'<p>'."\n"
			.'<label > *'.$LANG['Label_name'].' </label><br />'."\n"
			.'<input name="Nom" class="inputbox" type="text" >  </input>'."\n"
			.'</P>'."\n"
			.'<p>'."\n"
			.'<label > *'.$LANG['Label_mail'].' </label><br />'."\n"
			.'<input name="Mail" class="inputbox" type="text"  >  </input>'."\n"
			.'</P>'."\n"	
			.'<input type="button"  class="button"  onclick="verifie_oubliercompte(this.form)" value="'.$LANG['Label_send'].'"/>	'."\n" 
			.'<input type="hidden" name="option" value="action" />'."\n"
			.'<input type="hidden" name="composant" value="cob" />'."\n"
			.'</FORM>'."\n"
			.'</fieldset >'."\n"
			.'</div>'."\n";
	return $contenu;	
}
?>