<?php
require("../../system.admin.php");
$repertoire=$_POST['dir'];
$fichier=$_POST['file'];
//$test=recove_backup("kernel/","configuration_var1_test.php");
$test=recove_backup($repertoire,$fichier);
if ($test==true)
{
echo"Fichier recupere";
}
else
{
echo'{success: false,errors: {title: "Dopa"},errormsg: "Impossible de recuperer le fichier"}';
}
?>