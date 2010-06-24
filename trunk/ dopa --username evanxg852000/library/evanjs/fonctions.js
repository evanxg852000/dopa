function verifie_contact(formulaire)
{
if (formulaire.Nom.value=="" || formulaire.Email.value=="" || formulaire.Objet.value=="" || formulaire.Content.value==""    )
	{
		window.alert('Remplissez tous les champs précédés  de  * !')
	}
	else
	{
	  formulaire.submit()
	}	
};

function verifie_livreor(formulaire)
{
if (formulaire.Nom_lo.value=="" || formulaire.Contenu_lo.value==""  )
	{
		window.alert('Remplissez tous les champs précédés  de  * !')
	}
	else
	{
	  formulaire.submit()
	}	
};

function verifie_creercompte(formulaire)
{
	if (formulaire.Mail_c.value=="" || formulaire.M_c.value=="" || formulaire.L_c.value=="" || formulaire.Nom_c.value==""  )
		{
			window.alert('Remplissez tous les champs précédés  de  * !')
		}
		else
		{
		  formulaire.submit()
		}	
};


function verifie_oubliercompte(formulaire)
{
	if (formulaire.Mail.value=="" ||  formulaire.Nom.value==""  )
		{
			window.alert('Remplissez tous les champs précédés  de  * !')
		}
		else
		{
		  formulaire.submit()
		}
};

function ajouter()
{


};

function metreajour()
{


};