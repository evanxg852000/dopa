function change_typebd(formulaire)
{
	if(formulaire.typedb.value=="sqlite")
	{
		document.getElementById('dbpath').disabled =false;
			
		document.getElementById('serveurbd').disabled =true;
		document.getElementById('userdb').disabled =true;
		document.getElementById('motpassdb').disabled =true;
	}
	else
	{
		document.getElementById('serveurbd').disabled =false;
		document.getElementById('userdb').disabled =false;
		document.getElementById('motpassdb').disabled =false;
		
		document.getElementById('dbpath').disabled =true;
	}
};


function initialisation(){
		document.getElementById('dbpath').disabled =true;
};



function verifie_form(formulaire)
{

   if (formulaire.nomst.value==""  || formulaire.titre.value=="" || formulaire.slogan.value=="" || formulaire.description.value=="" || formulaire.autheurst.value=="" || formulaire.nomets.value=="" || formulaire.tel.value=="" || formulaire.fax.value=="" || formulaire.email.value=="" || formulaire.adresse.value=="" )
	{
		window.alert('Remplissez tous les champs de la troisieme etape !')
	}
	else
	{
	   	document.getElementById('install').submit();
	}	
};