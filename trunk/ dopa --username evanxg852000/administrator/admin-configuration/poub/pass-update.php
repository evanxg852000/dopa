<?php
include("../../admin_library.php");

$contenu="";
if ((isset($_POST['Table']) && !empty($_POST['Table'])) && (isset($_POST['Num']) && !empty($_POST['Num']))) 
{
$sql="SELECT* FROM ".$_POST['Table']." WHERE Num=".$_POST['Num'] ;
$result=select_rec ( $sql ) ;
$nb_ligne =mysql_num_rows($result);
				if ($nb_ligne<=0 )
				{
						$contenu="Aucun contenu corespondant a ce parametre";
				} 
				else
				{
					while ( $list = mysql_fetch_array( $result) ) 
					   {
						$contenu=  $list['Contenu'];
						   
					   }  					
					
				}
		
}
else
{
$contenu="Aucun element selectione";
}
echo $contenu;
?>
