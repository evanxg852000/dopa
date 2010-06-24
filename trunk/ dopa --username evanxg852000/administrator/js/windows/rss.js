MyDesktop.Rss = Ext.extend(Ext.app.Module, {
    id:'rssnews',
    init : function(){
        this.launcher = {
            text: 'Gestion Rss',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

	createWindow : function(){
        var desktop = this.app.getDesktop();
		
	//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Titre', 'Lien', 'Description','Date']); // modele de la table
			
      var sto=new Ext.data.Store({
			url: 'admin-rss/rssnews.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model )
	    });
	 //fin instance 			

	// variable edition du grid
		//var Num_edit = new Ext.form.TextField({valueField: 'id'}) // non editable car c'est l'id;
		var Titre_edit = new Ext.form.TextField();
		var Lien_edit = new Ext.form.TextField();
		var Description_edit = new Ext.form.TextField();
		var Date_edit = new Ext.form.DateField({format: 'm/d/Y'});
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:sto,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 50, dataIndex: 'Num', sortable: true},
								{header: "Titre", width: 140, dataIndex: 'Titre', editor: Titre_edit , sortable: true},
								{header: "Lien", width: 140, dataIndex: 'Lien', editor: Lien_edit , sortable: true},
								{header: "Description", width: 200, dataIndex: 'Description', editor: Description_edit , sortable: true},
								{header: "Date", width: 90, dataIndex: 'Date', editor: Date_edit , sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-rss/rssnews-update.php',
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
												var x= gride.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-rss/rssnews-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Titre:'New Rss',
														Num: x+1
													},
													success: function(resp,opt) {		
																			var x= gride.getStore().getCount();
																			gride.getStore().insert(x, new ds_model({Num: x+1, Titre:'New Rss', Lien:'', Description:'' , Date:''}));
																			gride.startEditing(gride.getStore().getCount()-1,1);
													},
													failure: function(resp,opt) {
														Ext.Msg.alert('Error','Ajout Impossible !');
													}
												});

												
												
							}//info() est defini dans divers/function
                        },'-',{
                            text:'Supprimmer',
                            tooltip:'Remove the selected item',
                            iconCls:'remove',
							handler: function(){
												var sm = gride.getSelectionModel();
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
																	url: 'admin-rss/rssnews-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		gride.getStore().remove(sel); 
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
										sto.load();				
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
//fin dessin du gride
				
				
//===============================================FIN inserer les variable (var pari= new) ici=================================
				
//creation de la fenetre 				
        var win = desktop.getWindow('rssnews');
        if(!win){
            win = desktop.createWindow({
                id: 'rssnews',
                title:'Gestion Rss',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride,	//encapsulation du gride dans la fenetre
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-rss',
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
			var mask_rss = new Ext.LoadMask(Ext.get('rssnews'), {store:sto,msg:'Chargement...'}); //effet pour le chargement de donnee 
			sto.load();
        }
        win.show();
    }
});

