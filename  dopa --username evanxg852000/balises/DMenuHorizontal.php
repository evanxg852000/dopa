<?php
function Getmenuoption()
{
	Global $LANG,$DB_PREF;
	$sql='SELECT* FROM '.$DB_PREF.'menu where Num=1' ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	if (count($resultat)<=0)
	{
		return 'Menu Simple';
	}
	else
	{
		return $resultat[0]['Type']; //deroulanet
	}
}

function MenuHorizontal() 
{
	Global $LANG,$DB_PREF;
	$sql='SELECT* FROM '.$DB_PREF.'categorie where Publie="Y"' ;
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);	
	$option=Getmenuoption();
	switch($option)
	{
		case 'Menu Simple':
				echo '<ul id="menuhorizontal">'."\n";
							for($i=0;$i<count($resultat);$i++)
							{
								echo  '<li id="elem.'.$i.'"> <a href="index.php?option=view&composant=cat&id='.$resultat[$i]['Num'].'">'.$resultat[$i]['Nom'].'</a></li>'."\n";
							}
								echo  '<li id="elem.'.$i.'"> <a href="index.php?option=view&composant=con">'.$LANG['Label_contact'].'</a></li>'."\n";
			    echo '</ul>'."\n";
			break;
		case 'Menu Deroulant':	
				echo '<ul id="menuhorizontal">'."\n";
							for($i=0;$i<count($resultat);$i++)
							{
								$num=$resultat[$i]['Num'];
								echo  '<li id="elem_'.$i.'"> <a href="index.php?option=view&composant=cat&id='.$resultat[$i]['Num'].'">'.$resultat[$i]['Nom'].'</a>'."\n";
									echo '<ul class="sousmenu">'."\n";
										$sql='SELECT* FROM '.$DB_PREF.'article where Publie="Y" and Num_ca='.$num ;
										$req=new DatabaseRequest($sql);
										$result_sous=$req->Select();	
										unset($req);
										for($j=0;$j<count($result_sous);$j++)
										{
											echo  '<li id="elem.'.$i.'.'.$j.'"> <a href="index.php?option=view&composant=art&id='.$result_sous[$j]['Num'].'">'.$result_sous[$j]['Nom'].'</a></li>'."\n";
										}	
									echo '</ul>'."\n";
								echo '</li>'."\n";
							}
							echo  '<li id="elem.'.$i.'"> <a href="index.php?option=view&composant=con">'.$LANG['Label_contact'].'</a></li>'."\n";
			    echo '</ul>'."\n";
			break;
	}
}
?>