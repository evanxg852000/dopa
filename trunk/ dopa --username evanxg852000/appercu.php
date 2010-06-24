<?php 
//verifie l'installation
include('system/WebApplication.class.php');	
$Dopa=new WebApplication();//instanciation de la page
$Dopa->Initialize() ; //creation de la page
Include('design/'.$_GET['design'].'/index_'.$MODE.'.php');
unset($Dopa); //destruction de l'objet de la page
?>