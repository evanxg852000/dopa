<?php
include('kernel/configuration_var.php'); //inclusion de la configuration
include('kernel/configuration.php');
include('library/evanphp/library.php');//inclusion des libraries
include('modules/modules.php'); //inclusion des modules
if ($LANGAGE=='fr')//inclusion des langues
{
include('language/fr.php');
}
else
{
include('language/en.php');
}

class WebApplication{
public $mode;
private $design;
private $valid;

function __tostring() {
    return "Cet objet emet une contruit les base de la page";
    }

  function __construct() { //constructeur
	 	
    }

function Initialize() //cette methode initialise les module
{	
	Global $SERVER,$USERNAME,$PASSSQL,$DBNAME,$ADMIN ,$VALID_PROCEDURE,$MODE,$DESIGN ;
    controleur();
	$this->mode=$MODE;
	$this->design=Get_design();
	$DESIGN=$this->design;
	
}

function Build() //retourne le design
{   
	Include('design/'.$this->design.'/index_'.$this->mode.'.php');
}
}

?>