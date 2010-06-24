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
$req2="SELECT* from news" ;
				$rest=select_rec (  $req2);
				$nb_ligne = mysql_num_rows($rest);
				
				echo "Nombre de signature: ".$nb_ligne ;
					
					//$list=mysql_fetch_row($rest);
				
				
				    $table=array();
					$nb_colone=mysql_num_fields($rest); //recuperation du nombre de colone
					$nb_ligne=mysql_num_rows($rest); //recuperation du nombre de ligne	
					for($i=0;$i<$nb_ligne;$i++)   //parcours de lignes
					{
						$list=mysql_fetch_row($rest); //selectione une ligne deplace le pointeur a chaque iteration
						for($j=0;$j<$nb_colone;$j++)
						{
							$nom_colone=mysql_field_name($rest, $j); //recuperation du nom de la colone par indice
							$table[$i][$nom_colone]= $list[$j];
						}					
					}
					
					echo count($table);
					echo $table[4]['Nom'];
					
					
//parcourir un tableau associatif

		
              
	
?>