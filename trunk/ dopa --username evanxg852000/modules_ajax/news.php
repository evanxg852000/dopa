<?php
function flash()
{       
	    Global $LANG;
		$critere=rand(1, 5); 
		$req=" Select* from news where Num=".$critere ;
		$result=select_rec ( $req ) ;
		$nb_ligne = mysql_num_rows($result);
		while ( $list = mysql_fetch_array( $result) ) 
		{
		echo'<p>';	
		echo "<b>".$list['Nom']."</b><br>";	
		echo $list['Contenu'];
		echo'<A class="readon" href="index.php?option=news&id='.$list['Num'].'">'.$LANG['readon'].'<A>';
		echo'</p>';
		}	
}	

function news()
{
		Global $LANG;
		$critere=rand(1, 5); 
		$req=" Select* from news " ;
		$result=select_rec ( $req ) ;
		$nb_ligne = mysql_num_rows($result);
		echo '<div >'; //entete
		echo $LANG['news'];	
		echo '<div id=" ">';
		echo '<ul >';
		while ( $list = mysql_fetch_array( $result) ) 
		{
		echo'<li><A class="readon" href="index.php?option=news&id='.$list['Num'].'">'.$list['Nom'].'<A><li>';
		}	
		echo '</ul>';	
		echo '</div>';
		echo '</div>';

}	
?>