<?php

   //affichage de l'entête du tableau
   echo
   "
   <table border=1 align=center>
   <tr>
   <td>Image</td>
   <td>Nom de l'image</td>
   </tr>
   ";
    
   //nom du répertoire contenant les images à afficher 
   $nom_repertoire = 'image/';

   //ouvre le repertoire
   $pointeur = opendir($nom_repertoire); 
   $i = 0; 

   //stocke les noms de fichiers images dans un tableau
   while ($fichier = readdir($pointeur)) {
   if (substr($fichier, -3) == "gif" ||
       substr($fichier, -3) == "jpg" ||
       substr($fichier, -3) == "png" ||
       substr($fichier, -4) == "jpeg" ||
       substr($fichier, -3) == "PNG" ||
       substr($fichier, -3) == "GIF" ||
       substr($fichier, -3) == "JPG")
      { 
       $tab_image[$i] = $fichier;
       $i++;
      }       
   } 
    
   //on ferme le répertoire 
   closedir($pointeur); 

   //on trie le tableau par ordre alphabétique 
   array_multisort($tab_image, SORT_ASC); 

   //affichage des images (en 60 * 60 ici)
   for ($j=0;$j<=$i-1;$j++) 
   { 
   $image = '<img src="'.$nom_repertoire.'/'.$tab_image[$j].'"  width="60" height="60">';

   // affichage bas du tableau
   echo
   '
   <tr>
   <td align="center">'.$image.'</td>
   <td align="center">'.$tab_image[$j].'</td>
   </tr>
   ';
   } 
   echo '</table>';

?>