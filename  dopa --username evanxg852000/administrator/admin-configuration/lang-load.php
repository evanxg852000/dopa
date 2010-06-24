<?php
$arr=array(	 
array(  "Id"=>"1", "Lang"=>"fr"),
array(  "Id"=>"2", "Lang"=>"en")
//array(  "Id"=>"2", "Lang"=>"Ch") pour ajoueter des lang
);
Echo '{rows:'.json_encode($arr).'}';
?>