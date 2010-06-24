<?php
include("../../system.admin.php");

$raport=array();
$type_des=$_POST['Type'];   //design ou plugin
$num_des=$_POST['Num'];//numero enregistement	
$nom_des=$_POST['Nom']; //nom du truc a desinstaller util pour le cas d'un template
$lien_des=$_POST['Lien']; //lien de dossier util pour un plugin

//1ere etape: chercher le bon repertoire
switch($type_des)
	{
		case 'design':
				$repertoire=$PATH_ROOT."design/".$nom_des."/";
				$desinscriptionSQL="DELETE FROM ".$DB_PREF."template WHERE Num=".$num_des;
			break;
		case 'plugin':
				$repertoire=$PATH_ROOT."plugins/".$lien_des."/";
				$desinscriptionSQL="DELETE FROM ".$DB_PREF."plugins WHERE Num=".$num_des;
			break;
	}

//2em etape: lire le fichier de desinstalation 
	$xml = new InstallParser($repertoire.'desinstall.xml');
    $name=$xml->name; //name dans le xml doit etre le meme nom du fichier zip
	$type=$xml->type;
	$lien=$xml->lien;
	$version=$xml->version;
	$files=$xml->files;
	$sqls=$xml->sqls;

//3em etape: executer les requetes sql
//desinscription dans plugin ou design
	$req=new DatabaseRequest($desinscriptionSQL);
	$resultat=$req->Request();
	unset($req);
	if(!$resultat)
	{
		$raport[0]=false;
	}

for($i=0;$i<count($sqls);$i++)
{
	$sql=$sqls[$i];
	if ($sql!="null" && $sql!="")
	{
		$req=new DatabaseRequest($sql);
		$resultat=$req->Request();
		unset($req);
		if(!$resultat)
		{
			$raport[1]=false;
		}
	}
	
}

//4em etape: suppression des repertoires
$mon_rep=new Repertoire($repertoire);	
$test=$mon_rep->RepSupprimer();
unset($mon_rep);
if(!$test)
{
	$raport[2]=false;
}

//5em etape: on traite les error du raport
if (count($raport)==0)
{
	echo 'Desintaller  avec succes';
}
else
{
	echo 'Echeque de la desinstallation';
}
?>