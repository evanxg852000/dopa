<?php

$arr=array(
      array(
          "Author"=>" Sheldon",
		  "Manufacturer"=>"Warner",
		  "ProductGroup"=>"Book",
		  "Title"=>"Master of the Game",
     ),
      array(
          "Author"=>"Sidney Sheldon",
			"Manufacturer"=>"Warner",
			"ProductGroup"=>"Book",
			"Title"=>"Master of the Game",
     ),
      array(
          "Author"=>"Sidney ",
			"Manufacturer"=>"Warner",
			"ProductGroup"=>"Book",
			"Title"=>"Master of the Game",
     )
);

	Echo '{success:true,rows:'.json_encode($arr).'}';



?>
