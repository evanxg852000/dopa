<?php
//inclusion de la configuration
include('kernel/configuration_var.php');
include('kernel/configuration.php');

//inclusion des libraries
include('library/evanphp/library.php');

//inclusion des modules
include('modules/modules.php');

//inclusion des langues
if ($LANGAGE=='fr')
{
include('language/fr.php');
}
else
{
include('language/en.php');
}


?>