<?php
function DIndex() //cette fonction affiche tous les articles pubie en prmiere page
{
	$sql="SELECT* FROM ".$DB_PREF."article where Publie='Y' AND Publie_ho='Y'";
	$req=new DatabaseRequest($sql);
	$resultat=$req->Select();	
	unset($req);
	for($i=0;$i<count($resultat);$i++)
	{
		$info='Le samedi 24 juin ; 23h30';
		echo '<div class="article">'."\n";
			echo '<div class="entetearticle"><h2>'.$resultat[$i]['Nom'].'</h2></div>'."\n";
				echo '<p class="infos">'.$info.'</p>'."\n";
				echo '<P>'.$resultat[$i]['Contenu'].'</p>'."\n";
		echo '</div>'."\n";
	}

}

function DConnexion()
{
}

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
	
	if (isset($_GET['composant']))
	{
		$composant=$_GET['composant'];
	}
	else
	{
		$composant='null';
	}
	
	if (isset($_GET['id']))
	{
		$num=$_GET['id'];
	}
	else
	{
		$num='null';
	}
	

//rechercher=
//index.php?option=[index,view,action,confirmation,]
// &composant=[contact=con,cherche=che,article=art,categorie=cat,connexion=cnx,contacts&mail=mai,voter=vot,resultatvote=rvo,creercompte=cct,compteoublie=cob]
// $confirmation=[mail,vote,createcompte,]
// &id=[num]
	

	
	switch ($option)
		{
			case 'index':
						DIndex();
				break;
			case 'view':
							switch ($composant)
								{
									case 'art':
											DArticle($num); //affiche un article specifique
										break;
									case 'cat':
											DCategorie($num); //affiche une categorie specifique
										break;
									case 'con':
											DContact(); //affiche les contacts de l'ets et un formulaire d'envoi mail
										break;
									case 'rvo':
											DResutatVote(); // affiche le resultat du vote
										break;	
									case 'cct':  //formulaire pour creer compte
											DCreerCompte(); //affiche le formulaire
										break;
									case 'cob': //formulair a remplir pour compte oublie
											DCompteOublie();
										break;
								}
				break;
			case 'action':
							switch ($composant)
								{
									case 'che': //cherche
											DResultatSearch(); //affiche le resultat d'une recherche
										break;
									case 'mai': //envoi mail
											DEnvoiMail(); //soumet le formulaire mail prerempli
										break;
									case 'vot': //vote
											DVote(); //soumet le formulaire vote prerempli
										break;
									case 'edi': //editer un article
										  //ouvre une fenetre externe pour editer un article non implemente
										break;
									case 'cct':  //confirmation creer compte
											DCreerCompteConfirm(); //soumet le formulaire creer compte prerempli
										break;
									case 'cob': //compte oublie
											DCompteOublieConfirm(); //soumet le formulaire  compte oublie prerempli
										break;
									case 'cnx': //connexion
											DConnexion();//soumet le formulaire  conexion prerempli
										break;
									case 'dcx': //deconnexion
											DDeconnexion();//soumet le formulaire  deconexion prerempli
										break;
								}				
				break;		
		}
}	


?>