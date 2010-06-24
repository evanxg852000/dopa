<?php
include('kernel/configuration_var.php'); 			//inclusion de la configuration
include('kernel/configuration.php');
include('library/evanphp/library.php');				//inclusion des libraries
include('balises/DBalises.php'); 					//inclusion des balises
$JSWIDGETS=array(); 								//initialisation des widgets javascrpt
$CONTENU=""; 										//contenu de la page
$ISCONECTED="" ; 									//permet de savoir letat du visiteur de facon global(or S_session[isconnected] est local a Initialize()

if ($LANGAGE=='fr')									//inclusion des langues
{
require_once('language/fr.php');
}
else
{
require_once('language/en.php');
}


class WebApplication{
public $mode;
private $design;
private $valid;

function __tostring() {
    return "Cet objet emet une contruit les bases de la page";
    }

  function __construct() { 							//constructeur
	 	
    }

public function Initialize() 						//cette methode initialise les module
{	
	Global $SERVER,$USERNAME,$PASSSQL,$DBNAME,$ADMIN ,$VALID_PROCEDURE,$MODE,$DESIGN,$ISCONECTED ;
    controleur();
	$this->mode=$MODE;
	$this->design=Get_design();
	$DESIGN=$this->design;
	session_start(); 								//on creer la session qui ne sera pas detruite mais sa varible identified changera selon l'etat du visiteur (conete ou deconecte)
	if ($_SESSION['ISCONECTED'])
	{
		$ISCONECTED=true ;
	}
	else
	{
		$ISCONECTED=false;
	}
	$_SESSION['LOGIN']="";
	$_SESSION['MOTPASS']="";
}

public function Build() 							//retourne le design
{   
		Global $SITENAME,$GREET_MSG,$CONTENU;
		
		
		if (isset($_GET['comp'])) 						//comp=composant [index,aricle(Dart),categorie(Dcat),extention(Dext),]
		{
			$composant=$_GET['comp'];
		}
		else
		{
			$composant='index';
		}
		
		if (isset($_GET['opt'])) 						//opt=option [view,action,confirm]
		{
			$option=$_GET['opt'];
		}
		else
		{
			$option='view';
		}
		
		if (isset($_GET['tok'])) 						//tok=token=id
		{
			$num=$_GET['id'];
		}
		else
		{
			$num='null';
		}
		
		if (isset($_GET['ext'])) 						//ext=nom de lextention
		{
			$ext_name=$_GET['ext'];
		}
		else
		{
			$ext_name='null';
		}
		
		switch ($composant)
		{
			case 'index': 								//composant gerant laffichage par defaut la page index	
						switch($option)
						{
							case 'view':
									$CONTENU=S_DIndex();
							break;
							case 'action':
							break;
							case 'confirm':
							break;
							default : ;					//aller sur la page notfound;
						}
			break;
			case 'Dart': 								//composant gerant les article
					
						switch($option)
						{
							case 'view':
								$CONTENU=S_DArticle($num); 
							break;
							case 'action':
							break;
							case 'confirm':
							break;
							default : ;					//aller sur la page notfound;
						}
			break;
			case 'Dcat': 								//composant gerant les catgorie
					
						switch($option)
						{
							case 'view':
								$CONTENU=S_DCategorie($num); 
							break;
							case 'action':
							break;
							case 'confirm':
							break;
							default : ;					//aller sur la page notfound;
						}
			break;
			//======================================a inserer==================
			case 'Dprototype': 								//affiche une categorie specifique
					$CONTENU=S_DCategorie($num); 
						switch($option)
						{
							case 'view':
							break;
							case 'action':
							break;
							case 'confirm':
							break;
							default : ;					//aller sur la page notfound;
						}
			break;
			
			//================================================================
			case 'Dext':
				$filename="extentions/Dext-".$ext_name."/Dext-index.php";
				if(file_exists($filename))
				{
					require_once($filename);
					//$e=new Extention();
					//$CONTENU=$e->build();
					//unset($e);
				}
				else
				{
					//aller sur la page not found
				}
			break;
			default:  ;//aller sur la page notfound;
		}
		require_once('design/'.$this->design.'/index_'.$this->mode.'.php');
	}
		
}
?>