<?php
include('kernel/configuration_var.php'); //inclusion de la configuration
include('kernel/configuration.php');
include('library/evanphp/library.php');//inclusion des libraries
if ($LANGAGE=='fr')//inclusion des langues
{
include('language/fr.php');
}
else
{
include('language/en.php');
}
?>