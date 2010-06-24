<?php
//fichier permetant de connaitre la taille max d'upload autorise default WAMP:8388608 o
	include("../../system.admin.php");

$MAX_FILE_SIZE=get_max_size();	
echo $MAX_FILE_SIZE;
?>