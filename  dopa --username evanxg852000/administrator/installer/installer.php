<?php
include("../../system.admin.php");
$raport=array();
//1ere etape: upload dans temp
$type_autorise=array(0=>"application/zip");
$repertoire_upload=$PATH_ROOT."tmp/";
$downfile=new DownloadUpload($repertoire_upload,$type_autorise);
$test=$downfile->Upload($_FILES);
if(!$test)
{
 $raport[0]=false;
}

//2em etape: extaraire 
$pieces= explode(".",$_FILES['fichier']['name'][0] ); 
$nom_fichier_uplode= $pieces[0]; 
$dezip = new Zip($repertoire_upload,$nom_fichier_uplode);
$tes=$dezip->ExtraireFichier($repertoire_upload);
if(!$tes)
{
$raport[1]=false;
}


//3em etape: lire le fichier install et recuperer les info
	$xml = new InstallParser($repertoire_upload.$nom_fichier_uplode.'/install.xml');
    $name=$xml->name; //name dans le xml doit etre le meme nom du fichier zip
	$type=$xml->type;
	$lien=$xml->lien;
	$version=$xml->version;
	$files=$xml->files;
	$sqls=$xml->sqls;
	switch($type)
	{
		case 'design':
				$destination_finale=$PATH_ROOT."design/";
				$inscriptionSQL="INSERT INTO ".$DB_PREF."template ( Num , Nom ,Etat) VALUES ( Null,'".$name."',0)";
			break;
		case 'plugin':
				$destination_finale=$PATH_ROOT."plugins/";
				$inscriptionSQL="INSERT INTO ".$DB_PREF."plugins ( Num , Nom,Lien ,Publie) VALUES ( Null,'".$name."','".$lien."','Y')";
			break;
	}

//4em etape: copier dans la destination finale le fichier zip et le deziper encore;
$fichier=new Fichier($repertoire_upload.$nom_fichier_uplode.'.zip');
$test=$fichier->CopierFichier($destination_finale.$nom_fichier_uplode.'.zip');	
if(!$test)
{
$raport[2]=false;
}

//5em etape: effacer le fichier zip uploade
$test=$dezip->EffaceArchive();
unset($dezip);
if(!$test)
{
$raport[3]=false;
}


//6em etape on extrait le fichier zip copier dans la destination finale
$dezip = new Zip($destination_finale,$nom_fichier_uplode);
$tes=$dezip->ExtraireFichier($destination_finale);
$dezip->EffaceArchive();
unset($dezip);
if(!$tes)
{
$raport[4]=false;
}


//7em etape: executer les requetes sql
//inscription dans plugin ou design
	$req=new DatabaseRequest($inscriptionSQL);
	$resultat=$req->Request();
	unset($req);
	if(!$resultat)
	{
		$raport[5]=false;
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
			$raport[6]=false;
		}
	}
	
}	
	
//8em etape : on efface le dossier dans tmp
$chemin=$repertoire_upload.$nom_fichier_uplode;
$mon_rep=new Repertoire($chemin);	
$test=$mon_rep->RepSupprimer();
unset($mon_rep);
if(!$test)
{
	$raport[7]=false;
}
//9em etape: on traite les error du raport
if (count($raport)==0)
{
	echo '{success:true, msg:'.json_encode('Fichier uploader avec succes').'}';
}
else
{
	echo '{success:true, msg:'.json_encode('Echeque de l\'installation du fichier').'}';
}
?>