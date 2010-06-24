<?php
Include('library.php');

$req = 'SELECT* From rssnews';
$result=select_rec ( $req ) ;
$nb_ligne =mysql_num_rows($result);

$arr = array();



		If ($result==false) 
		{
			Echo '{success:false}';
		}
		else
		{
			
				if ($nb_ligne<=0 )
				{
						$arr=array(
							  array(
								  "Num"=>"NO RECORD",
								  "Titre"=>"NO RECORD",
								  "Lien"=>"NO RECORD",
								  "Description"=>"NO RECORD",
								  "Date"=>"NO RECORD"
							 ));

					Echo '{success:true,rows:'.json_encode($arr).'}';
				} 
				else
				{
						while($obj = mysql_fetch_object($result)){
							$arr[] = $obj;
						}
						Echo '{success:true,rows:'.json_encode($arr).'}';		
				}
		}

?>
