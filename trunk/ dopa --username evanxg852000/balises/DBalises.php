<?php
//inclusion des balises utilisateur
require_once("DHead.php");
require_once("DDay.php");
require_once("DCalender.php");
require_once("DBanner.php");
require_once("DImage.php");
require_once("DSearch.php");
require_once("DNews.php");
require_once("DEnligne.php");
require_once("DNewsletter.php");
require_once("DRss.php");
require_once("DMenuHorizontal.php");
require_once("DMenu.php");
require_once("DExtentions.php");
require_once("DContenu.php");
require_once("DContact.php");
require_once("DSondage.php");
require_once("DPublicite.php");
require_once("DIdentification.php");
require_once("DFooter.php");

//inclusion des balises systeme 
//NB ces balises sont utilisees par le core Webapplication et ne devrait pas etre appelle ou modifier (a mois de savoir ce vous faite)
//leur nom est precede de S_DXxxxxx
require_once("S_DIndex.php");
require_once("S_DArticle.php");
require_once("S_DCategorie.php");
require_once("S_DContact.php");
require_once("S_DResutatVote.php");
require_once("S_DCreerCompte.php");
require_once("S_DCompteOublie.php");
require_once("S_DResultatSearch.php");
require_once("S_DEnvoiMail.php");
require_once("S_DVote.php");
require_once("S_DCreerCompteConfirm.php");
require_once("S_DCompteOublieConfirm.php");
require_once("S_DConnexion.php");
require_once("S_DDeconnexion.php");
?>