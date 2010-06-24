<?php
//affiche si l'admin est en ligne    <B class=cli_d>DESACTIVE</B>
function admin_online()
{
	Global $LANG;
	$req='SELECT* FROM utilisateur WHERE Etat="Y"' ;
    $result=select_rec ( $req ) ;
		$nb_ligne = mysql_num_rows($result);	
	echo '<div class="admin_online">';
	if ($nb_ligne !=0)
	{
	echo $LANG['admin_state'].' : <B class=online>'.$LANG['activate'].'</B><br><br>';

	while ( $list = mysql_fetch_array( $result) ) 
	   {
		echo $list['Nom'].' '.$LANG['admin_online'].'<br>';	
	   }
	   //echo "<br><a href='chat.php' target='_blank'><B>ENTRER EN CONTACT</B></a>";
	}
	else
	{
	echo  $LANG['admin_state'].' : <B class=offline>'.$LANG['desactivate'].'</B>';
	}		
	echo '</div>';      
}


?>