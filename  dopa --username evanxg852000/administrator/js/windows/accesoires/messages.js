function Message(){
        var desktop = this.app.getDesktop();
		
	    var ds_model_mail = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Email', 'Objet', 'Contenu','Lu','Date']); // modele de la table
        var store_mail=new Ext.data.Store({
			url: 'admin-messages/messages.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_mail )
	    });
	 //fin instance 			

//==========================================liste des mails=========================================================
		// dessin du grid (contenu de la fenetre) de la fenetre	
	
		var gride_mail=  new Ext.grid.EditorGridPanel({
                        border:false,
						height:180,
					    store:store_mail,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 50, dataIndex: 'Num', sortable: true},
								{header: "Email", width: 140, dataIndex: 'Email',  sortable: true},
								{header: "Objet", width: 140, dataIndex: 'Objet', sortable: true},
								{header: "Lu", width: 70, dataIndex: 'Lu', sortable: true},								
								{header: "Date", width: 90, dataIndex: 'Date' , sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						keys: [{}],
                        viewConfig: {
                            forceFit:true
                        },
                        tbar:[{
                            text:'Lire',
                            tooltip:'lire le message selectione',
                            iconCls:'read_mail',
							handler: function () { 

								var sm = gride_mail.getSelectionModel();
								var sel = sm.getSelected();
								if (sm.hasSelection()){
													var conn = new Ext.data.Connection();
																	conn.request({
																		url: 'admin-messages/messages-update.php',
																		params: {
																			action: 'lire',
																			Num: sel.data.Num
																		},
																		success: function(resp,opt) { 
																			mail_form.getForm().findField('message_lire').setValue(resp.responseText);
																		},
																		failure: function(resp,opt) { 
																			Ext.Msg.alert('Error','Suppression Impossible !'); 
																		}
																	   });
													}
													else
													{
														Ext.Msg.alert('Dopa','selectioner une ligne!');
													}
												}//info() est defini dans divers/function 
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
												var sm = gride_mail.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir supprimer '+sel.data.Titre+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-messages/messages-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		gride_mail.getStore().remove(sel); 
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
											}
							},'-',{
									text:'Raffraichir',
									tooltip:'Add a new row',
									iconCls:'refresh',
									handler: function () { 
										store_mail.load();				
									}							       	
							},'-',{
						    text:'Aide ?',
                            tooltip:'Add a new row',
                            iconCls:'help',
							handler: function () { 
								openhelp();				
							}//openhelp() est defini dans divers/function
						}]
                    });
//===============================================FIN liste mails=================================
//===============================================debut formulaire envoi mails=================================				
var mail_form = new Ext.FormPanel({
	    url: 'admin-messages/messages-submit.php',
        labelAlign: 'top',
        frame:true,
        bodyStyle:'padding:5px 5px 0',
        items: [{
            layout:'column',
            items:[{
                columnWidth:.5,
                layout: 'form',
                items: [{
                    xtype:'combo',
                    fieldLabel: 'Expediteur',
                    name: 'Expediteur',
					allowBlank :false,
					blankText: 'Ce champ est obligatoire',
					mode: 'local',
					store: ['ADMIN','ROBOT'],
                    anchor:'95%'
					},{
                    xtype:'textfield',
                    fieldLabel: 'Destinataire',
                    name: 'Destinataire',
					allowBlank :false,
					blankText: 'Ce champ est obligatoire',
					vtype:'email',
                    anchor:'95%'
                },{
					xtype:'textarea',//textarea htmleditor
					fieldLabel:'Message',            
					name:'contenu_message',
					allowBlank :false,
					blankText: 'Ce champ est obligatoire',
					height:100,
					anchor:'98%'				
				}]
				},{
                columnWidth:.5,
                layout: 'form',
                items: [{
					xtype:'htmleditor',//
					fieldLabel:'Lire Message',
					name:'message_lire',
					value:'Lire le message ici ...',
					height:200,
					anchor:'98%',
					enableFormat:false,
					enableLinks : false,
					enableFormat : false,
					enableAlignments:false,
					enableColors : false,
					enableFont :false,
					enableLists : false,
					enableSourceEdit : false,
					enableFontSize :false
                },{
					
				}]
            }]
        }],
        buttons:[{
				text: 'Envoyer',
				handler: function(){
                    mail_form.getForm().submit({
                        success: function(f,a){
                            Ext.Msg.alert('Dopa',a.result.msg);
                        },
                        failure: function(f,a){
                            if (a.failureType === Ext.form.Action.CONNECT_FAILURE){
                                Ext.Msg.alert('Echec', 'Server reported:'+a.response.status+' '+a.response.statusText);
                            }
                            if (a.failureType === Ext.form.Action.SERVER_INVALID){
                                Ext.Msg.alert('Warning', a.result.errormsg);
                            }
                        }
                    });
				}
			}, {
				text: 'Annuler',
				handler: function(){
					mail_form.getForm().reset();
				}
			}]

    });
				
				
				
//===============================================fin formulaire envoi mails=================================	

	
//creation de la fenetre 				
        var wini = desktop.getWindow('messages');
        if(!wini){
            wini = desktop.createWindow({
                id: 'messages',
                title:'Gestion Message',
				maximizable:false,
                width:740,
                height:480,
                iconCls: 'message',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                items:[gride_mail,mail_form]	//encapsulation du gride_mail dans la fenetre 
            });
			var mask_messages = new Ext.LoadMask(Ext.get('messages'), {store:store_mail,msg:'Chargement...'}); //effet pour le chargement de donnee 
			store_mail.load();
        }
        wini.show();
    }