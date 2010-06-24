MyDesktop.Users = Ext.extend(Ext.app.Module, {
    id:'users',
    init : function(){
        this.launcher = {
            text: 'Gestion Utilisteur',
            iconCls:'users',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_users = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Mot_pass', 'Nom', 'Login','Fonction','Niv_acces','Mail','Etat']); // modele de la table
			
      var strore_users=new Ext.data.Store({
			url: 'admin-users/users.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_users )
	    });
	
	 //fin instance 			

	// variable edition du grid
		//var Num_edit = new Ext.form.TextField({valueField: 'id'}) // non editable car c'est l'id;
		var Mot_pass_edit = new Ext.form.TextField();
		var Login_edit = new Ext.form.TextField();
		var Mail_edit = new Ext.form.TextField();
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_users=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:strore_users,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 80, dataIndex: 'Num', sortable: true},
								{header: "Mot_pass", width: 140, dataIndex: 'Mot_pass', editor: Mot_pass_edit , sortable: true},
								{header: "Nom", width: 140, dataIndex: 'Nom', sortable: true},
								{header: "Login", width: 120, dataIndex: 'Login', editor:  Login_edit , sortable: true},
								{header: "Fonction", width: 90, dataIndex: 'Fonction', sortable: true},
								{header: "Niveau acces", width: 120, dataIndex: 'Niv_acces', sortable: true},
								{header: "Mail", width: 120, dataIndex: 'Mail', editor: Mail_edit , sortable:false},
								{header: "Etat", width: 40, dataIndex: 'Etat',  sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var sm = gride_users.getSelectionModel();
										var sel = sm.getSelected();
										if (G_NUM_CONNECTE==sel.data.Num)
												{
														var conn = new Ext.data.Connection();
														conn.request({
																url: 'admin-users/users-update.php',
																method: 'POST',
																params: {
																	action: 'update',
																	Num: e.record.id,//G_NUM_CONNECTE
																	field: e.field,
																	value: e.value
																},
																success: function(resp,opt) {
																	    //Ext.Msg.alert('Dopa',resp.responseText); 
																		e.commit();										
																},
																failure: function(resp,opt) {
																	e.reject();
																}
															});
												}
												else
												{
													Ext.Msg.alert('Error','vous ne pouvez que modifiez votre compte.');
												}
										
									}
						
						},
						keys: [{}],
                        viewConfig: {
                            forceFit:true
                        },
                        //autoExpandColumn:'company',

                        tbar:[{
                            text:'Ajouter',
                            tooltip:'Add a new row',
                            iconCls:'add',
							handler: function () {
								    if(G_EST_SUPER_ADMIN==true)
									{
									//=====================================
								
										Ext.MessageBox.prompt('Dopa', 'Saisissez le nom de l\'utilisateur:', function (btn, text){
										var saisi_nom=text;
									 if (btn=='ok')
										  {
												var conn = new Ext.data.Connection();	
												conn.request({
													url: 'admin-users/users-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Nom:saisi_nom
													},
													success: function(resp,opt) {
																			//Ext.Msg.alert('Error',resp.responseText); 
																			var x= gride_users.getStore().getCount();
																			gride_users.getStore().insert(x, new ds_model_users({Num: x+1,Mot_pass:'undefined', Nom:saisi_nom, Login:'unknow_user',Fonction:'admin',Niv_acces:'Simple_admin',Mail:'undef@undef.com',Etat:'N' }));
																			gride_users.startEditing(gride_users.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});
										}
										else
										{
										  Ext.MessageBox.alert('Dopa', 'Operation anulle.');
										}
									});
						
						//===================================================
									}
									else
									{
										Ext.Msg.alert('Error','vous n\'avez le droit !');
									}
												
												
							}//info() est defini dans divers/function
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
								if(G_EST_SUPER_ADMIN==true)
													{
														var sm = gride_users.getSelectionModel();
														var sel = sm.getSelected();
														if (G_NUM_CONNECTE!=sel.data.Num) //verifie pour ne pas supprimer le super admni
														{
																	if (sm.hasSelection()){
																		Ext.Msg.show({
																			title: 'Dopa', 
																			buttons: Ext.MessageBox.YESNOCANCEL,
																			msg: 'Etes vous certain de vouloir supprimer '+sel.data.Nom+'?',
																			fn: function(btn){
																				if (btn == 'yes'){
																					
																					var conn = new Ext.data.Connection();
																					conn.request({
																						url: 'admin-users/users-update.php',
																						params: {
																							action: 'delete',
																							Num: sel.data.Num
																						},
																						success: function(resp,opt) { 
																							gride_users.getStore().remove(sel); 
																							Ext.Msg.alert('Error',resp.responseText); 
																						},
																						failure: function(resp,opt) { 
																							Ext.Msg.alert('Error','Suppression Impossible !'); 
																						}
																					});
																				}
																			}
																		});
																	}
																	else
																	{
																	Ext.Msg.alert('Dopa','selectioner une ligne!');
																	}
														}else
														{
															Ext.Msg.alert('Dopa','Le Super admin ne peut etre supprimmer !');
														}	
	
													}
													else
													{
														Ext.Msg.alert('Error','vous n\'avez le droit !');
													}
												
											}
							},'-',{
									text:'Enregistrer',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										strore_users.load();				
									}							       	
							},'-',{
						    text:'Aide ?',
                            tooltip:'Add a new row',
                            iconCls:'help',
							handler: function () { 
								openhelp();				
							}//openhelp() est defini dans divers/function
						}]
                    })
					;
//fin dessin du gride_users
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('users');
        if(!win){
            win = desktop.createWindow({
                id: 'users',
                title:'Gestion Utilisteurs',
                width:740,
                height:480,
                iconCls: 'users',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride_users,	//encapsulation du gride_users dans la fenetre 
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-users',
									items: [{
										text: 'Dopa Home',
										tooltip:'Aller sur le site',
										iconCls:'dopa',
										handler: function()	{
													window.open('http://evansofts.com');
												}
										}, '-',    new Date().format('n/d/Y')]
								})
            });
			var mask_users = new Ext.LoadMask(Ext.get('users'), {store:strore_users,msg:'Chargement...'}); //effet pour le chargement de donnee 
			strore_users.load();
        }
        win.show();
    }
});

