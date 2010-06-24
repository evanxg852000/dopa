<?php
include("../../system.admin.php");

$contenu_a_ecrire='<?php 
//variable globale creer et modifiable  dynamiquement 
//variable du site

$LANGAGE="'.$_POST['LANGAGE'].'"; 
$SITENAME="'.$_POST['SITENAME'].'";
$GREET_MSG="'.$_POST['GREET_MSG'].'";  //message de bienvenu du site 
$COPYRIGHT="'.$_POST['COPYRIGHT'].'";  //nom de l\'entreprise copyright 
$MODE="'.$_POST['MODE'].'";            // variable pour le mode affichage = ou (ajax) 
$KEYWORDS="'.$_POST['KEYWORDS'].'";

//variable de securite du site 
$VALID_PROCEDURE="'.$_POST['VALID_PROCEDURE'].'"; //secret 
$DELAI='.$_POST['DELAI'].';
$NB_CHARGEMENT_PAR_MN='.$_POST['NB_CHARGEMENT_PAR_MN'].';

//configuration administrateur
$EMAIL_ADMIN="'.$_POST['EMAIL_ADMIN'].'";
?>';

$bac=create_backup("kernel/","configuration_var.php");

$test_ecrirture=create_file("kernel/","configuration_var",$contenu_a_ecrire,"php");

if ($test_ecrirture==true)
{
echo'{success: true,errors: {title: "Dopa"},errormsg: "Impossible d\'ecrire le fichier de configration."}';
}
else
{
echo'{success: false,errors: {title: "Dopa"},errormsg: "Impossible d\'ecrire le fichier de configration"}';
}
?>