<?php 
// Set the level of error reporting
error_reporting(E_ALL & ~E_NOTICE);
	
//verifie l'installation
include('system/WebApplication.class.php');	

$Dopa=new WebApplication();//instanciation de la page

$Dopa->Initialize() ; //creation de la page

$Dopa->Build() ;//construction de la page

unset($Dopa); //destruction de l'objet de la page
?>