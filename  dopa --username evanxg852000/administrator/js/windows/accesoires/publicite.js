function Publicite(){
        var desktop = this.app.getDesktop();	
		
		var ds_model_pub = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Titre', 'Lien','Description','Publie']); // modele de la table
			
      var store_pub=new Ext.data.Store({
			url: 'admin-pub/pub.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_pub )
	    });
	 //fin instance 			

	// variable edition du grid
		
		var Titre_pub_edit = new Ext.form.TextField();
		var Lien_pub_edit = new Ext.form.TextField();
		var Description_pub_edit = new Ext.form.TextField();
															
					//==============================================fin recuperation des categorie pour remplir le combo======================
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride_pub=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_pub,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 70, dataIndex: 'Num', sortable: true},
								{header: "Titre", width: 180, dataIndex: 'Titre', editor:Titre_pub_edit , sortable: true},
								{header: "Lien", width: 190, dataIndex: 'Lien', editor:Lien_pub_edit , sortable: true},
								{header: "Description", width: 200, dataIndex: 'Description', editor:Description_pub_edit , sortable: true},
								{header: "Publie", width: 60, dataIndex: 'Publie' , sortable: true},
								
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-pub/pub-update.php',
											method: 'POST',
											params: {
												action: 'update',
											    Num: e.record.id,
												field: e.field,
												value: e.value
											},
											success: function(resp,opt) {
												e.commit();
											},
											failure: function(resp,opt) {
												e.reject();
											}
										});
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
							
												var x= gride_pub.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-pub/pub-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Titre:'New Pub',
														Num: x+1,
													},
													success: function(resp,opt) {		
																			gride_pub.getStore().insert(x, new ds_model_pub({Num: x+1, Titre:'New Pub',Lien:'http://',Description:'',Publie:'N'}));
																			gride_pub.startEditing(gride_pub.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});
							               }
							},{
                            text:'Publier',
                            tooltip:'Add a new row',
                            iconCls:'publish',
							handler: function () { 
											var sm = gride_pub.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir publier '+sel.data.Titre+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-pub/pub-update.php',
																	params: {
																		action: 'publie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_pub.load();
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
												
												
							}//info() est defini dans divers/function
                        },'-',{
                            text:'Depublier',
                            tooltip:'Remove the selected item',
                            iconCls:'unpublish',
							handler: function(){
												var sm = gride_pub.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir depublier '+sel.data.Titre+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-pub/pub-update.php',
																	params: {
																		action: 'depublie',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 store_pub.load();
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
									text:'Supprimer',
									tooltip:'Add a new row',
									iconCls:'remove',
									handler: function () { 
												var sm = gride_pub.getSelectionModel();
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
																	url: 'admin-pub/pub-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		 gride_pub.getStore().remove(sel);
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
									text:'Enregistrer',
									tooltip:'Add a new row',
									iconCls:'save',
									handler: function () { 
										store_pub.load();				
									}							       	
									},'-',{
						    text:'Aide ?',
                            tooltip:'Add a new row',
                            iconCls:'help',
							handler: function () { 
								openhelp();				
							}
						}]
                    })
					;
//fin dessin du gride_pub
				
				

//creation de la fenetre

		
        var wini = desktop.getWindow('publicite');
        if(!wini){
            wini = desktop.createWindow({
                id: 'publicite',
                title:'Gestion Publicite',
                width:650,
                height:350,
                iconCls: 'publicite',
				shadow:true,
                shim:false,
				layout: 'fit',
				items: gride_pub,
                animCollapse:false,
                constrainHeader:true,
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-dopa',
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
		var mask_pub = new Ext.LoadMask(Ext.get('publicite'), {store:store_pub,msg:'Chargement...'});  
			store_pub.load();
        }
        wini.show();
    }