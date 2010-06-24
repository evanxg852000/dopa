<?php
 echo dirname(realpath("realpath.php")); 
echo '<br>'.realpath('../index.php'); 

$pointeur = opendir('bac');
$i = 0; 
   while ($fichier = readdir($pointeur)) {
	   if( substr($fichier, -1)!="." )
	    {  
			
		echo '<br>';
          echo $fichier;
		echo '<br>';
		
		
		}
   } 
   
?>