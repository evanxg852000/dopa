<?php
class dbmysql{
private $dbname;
private $handle_con;
private $raport=array();
function __construct($name,$server,$user,$pass) 
 {
	$this->dbname=$name;
	$this->handle_con= mysql_connect($server,$user,$pass);
	if (!$this->handle_con) {
		die('Connexion impossible : ' . mysql_error());
	}
	if (mysql_query('CREATE DATABASE '.$this->dbname,$this->handle_con)) {
		//nothing
	} 
	else 
	{
		$i=count($this->raport);
		$this->ratport[$i]=false;
	}
 }

function createtables($tables) 
 {
	 mysql_select_db($this->dbname);
	 for($i=0;$i<count($tables);$i++)
	 {
		if(mysql_query($tables[$i], $this->handle_con))
		{
		}
		else
		{
			$j=count($this->raport);
			$this->ratport[$j]=false;
		}
	 }
	 if (count($this->raport)==0)
	 {
		return true;
	 }
	 else
	 {
		return false ;
	 }
	 mysql_close() ;
 }
}

class dbsqlite{
private $dbpath;
private $dbname;
private $handle;
private $raport=array();

function __construct($path,$name) 
 {
	$this->dbpath=$path;
	$this->dbname=$name;
	if ($db = sqlite_open($path.$name)) 
	{
		$this->handle=$db;
	} 
	else
	{
		$j=count($this->raport);
		$this->ratport[$j]=false;
	}
 }

function createtables($tables) 
 {
	 for($i=0;$i<count($tables);$i++)
	 {
		if(sqlite_query($this->handle,$tables[$i]))
		{
			//nothing
		}
		else
		{
			$j=count($this->raport);
			$this->ratport[$j]=false;
		};
	 }
	 if (count($this->raport)==0)
	 {
		return true;
	 }
	 else
	 {
		return false ;
	 }
 }
}

function get_path($path)//$path= $_SERVER['SCRIPT_FILENAME'];
	{
			// permet de connaitre le PATH_ROOT a partir du repertoire : ../projet/install/path.php
		$path=dirname($path); //on a: C:/wamp/www/Dopa
		//scinde le chemenin en morceau
		$pieces = explode("/", $path);
		//compte  les morceaux
		$taille=count($pieces);
		
		//remonte d'un cran en arriere du chemin on a: C:/wamp/www/
		for ($i=0;$i<=$taille-2;$i++)
		{
		  $res=$res.$pieces[$i].'/';	
		}
		return $res;
	}
	
function createconfig($name,$content)
{
	$fp = fopen($name, 'w');
	if(fwrite($fp,$content))
	{
		fclose($fp);
		return true;
	}
	else
	{
		fclose($fp);
		return false;
	}
}
?>