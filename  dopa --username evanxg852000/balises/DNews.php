<?php
function DFlashNews()
{       
	    Global $LANG,$DB_PREF ;
		
		$sql = 'SELECT* From '.$DB_PREF.'news';
		$req=new DatabaseRequest($sql);
		$resultat=$req->Select();	
		unset($req);
		$critere=rand(1,count($resultat)); 
		$sql = 'SELECT* From '.$DB_PREF.'news where Num='.$critere ;
		$req=new DatabaseRequest($sql);
		$resultat=$req->Select();	
		unset($req);
		echo'<p>'."\n";	
		echo "<b>".$resultat[0]['Nom']."</b><br>"."\n";	
		echo $resultat[0]['Contenu']."\n";
		echo'<A class="readon" href="index.php?option=voire&composant=news&id='.$resultat[0]['Num'].'">'.$LANG['readon'].'<A>'."\n";
		echo'</p>'."\n";
}	

function DNews()
{
	    Global $LANG,$DB_PREF ;
		$contenu="";
		$sql = 'SELECT* From '.$DB_PREF.'news';
		$req=new DatabaseRequest($sql);
		$resultat=$req->Select();	
		unset($req);
		echo $LANG['news'];	
		echo '<ul >'."\n";
		for($i=0;$i<=count($resultat);$i++) 
		{
		echo'<li><A class="suite" href="index.php?option=voire&composant=news&id='.$resultat[$i]['Num'].'">'.$resultat[$i]['Nom'].'<A><li>'."\n";
		}	
		echo '</ul>'."\n";	
}	
/*exple
	<div id="dflashnews">
		<?php DFlashNews(); ?>
	</div>
	
	<div id="dnews">
		<?php DNews(); ?>
	</div>
*/
?>