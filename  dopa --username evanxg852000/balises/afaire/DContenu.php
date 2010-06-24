<?php
//rechercher=
//index.php?option=[index,view,action,confirmation,]
// &composant=[contact,cherche,article,categorie,connexion,contacts&mail,voter,resultatvote,creercompte,compteoublie]
// &id=[num]
function DContenu()
{
	if (isset($_GET['option']))
	{
		$option=$_GET['option'];
	}
	else
	{
		$option='index';
	}

	switch ($option)
		{
			case 'index':
				$sql="SELECT* FROM ".$DB_PREF."article where Publie='Y' AND Publie_ho='Y'";
				$req=new DatabaseRequest($sql);
				$resultat=$req->Select();	
				unset($req);
				for($i=0;$i<count($resultat);$i++)
					{
						afficher_article($resultat[$i]['Non'],$resultat[$i]['Contenu'],'Le samedi 24 juin ; 23h30')
					}
				break;
			case 'view':
				
				break;
			case 'action':
				
				break;		
			case 'confirmation':
				
				break;		
		}
}	

	
	
	
function afficher_article($titre,$contenu,$info)
{
	echo '<div class="article">'."\n";
		echo '<div class="entetearticle"><h2>'.$titre.'</h2></div>'."\n";
				echo '<p class="infos">'.$info.'</p>'."\n";
				echo '<P>'.$contenu.'</p>'."\n";
	echo '</div>'."\n";
}

?>