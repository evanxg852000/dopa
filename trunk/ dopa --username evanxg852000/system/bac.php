<?php
	
	
	
//rechercher=
//index.php?option=[index,view,action,confirmation,]
// &composant=[contact=con,cherche=che,article=art,categorie=cat,connexion=cnx,contacts&mail=mai,voter=vot,resultatvote=rvo,creercompte=cct,compteoublie=cob]
// $confirmation=[mail,vote,createcompte,]
// &id=[num]
	

	
	switch ($option)
		{
			case 'index':
					$CONTENU=S_DIndex();
				break;
			case 'view':
							switch ($composant)
								{
									case 'art':
											$CONTENU=S_DArticle($num); //affiche un article specifique
										break;
									case 'cat':
											$CONTENU=S_DCategorie($num); //affiche une categorie specifique
										break;
									case 'con':
											$CONTENU=S_DContact(); //affiche les contacts de l'ets et un formulaire d'envoi mail
										break;
									case 'rvo':
											$CONTENU=S_DResutatVote(); // affiche le resultat du vote
										break;	
									case 'cct':  //formulaire pour creer compte
											$CONTENU=S_DCreerCompte(); //affiche le formulaire
										break;
									case 'cob': //formulair a remplir pour compte oublie
											$CONTENU=S_DCompteOublie();
										break;
									case 'news': //formulair a remplir pour compte oublie
											$CONTENU='comming soon';
									break;
								}
				break;
			case 'action':
							switch ($composant)
								{
									case 'che': //cherche
											$CONTENU=S_DResultatSearch($_GET['motcle']); //affiche le resultat d'une recherche
										break;
									case 'mai': //envoi mail
											$CONTENU=S_DEnvoiMail($_GET['Nom'],$_GET['Email'],$_GET['Objet'],$_GET['Content']); //soumet le formulaire mail prerempli
										break;
									case 'vot': //vote
											$CONTENU=S_DVote($_GET['num_so'],$_GET['sondage_reponse']); //soumet le formulaire vote prerempli
										break;
									case 'edi': //editer un article
										  //ouvre une fenetre externe pour editer un article non implemente
										break;
									case 'cct':  //confirmation creer compte
											$CONTENU=S_DCreerCompteConfirm(); //soumet le formulaire creer compte prerempli
										break;
									case 'cob': //compte oublie
											$CONTENU=S_DCompteOublieConfirm(); //soumet le formulaire  compte oublie prerempli
										break;
									case 'cnx': //connexion
											$CONTENU=S_DConnexion();//soumet le formulaire  conexion prerempli
										break;
									case 'dcx': //deconnexion
											$CONTENU=S_DDeconnexion();//soumet le formulaire  deconexion prerempli
										break;
								}				
				break;	
				case 'extention': //va socupper de recuperer toute les extention 
					$e=new extention();
					$CONTENU=$e->build();
				break;