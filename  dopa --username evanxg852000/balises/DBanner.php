<?php
function DBanner($liste)
{
	$select=rand(1, count($liste))-1;
	echo '<img src="media/banner/'.$liste[$select].'" alt="Banniere" align="left" />';
}
?>