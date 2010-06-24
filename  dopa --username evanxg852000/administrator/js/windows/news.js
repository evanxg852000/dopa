MyDesktop.News = Ext.extend(Ext.app.Module, {
    id:'news',
    init : function(){
        this.launcher = {
            text: 'Gestion News',
            iconCls:'icon-grid',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();
			//===============================================inserer les variable (var pari= new) ici=================================
		
		var ds_model_news = Ext.data.Record.create([   {name: 'Num', mapping: 'Num'},'Nom','Publie','Date']); // modele de la table
			
      var store_news=new Ext.data.Store({
			url: 'admin-news/news.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'Num'
			},ds_model_news )
	    });
	 //fin instance 			

	// variable edition du grid
		
		var Nom_edit = new Ext.form.TextField();
		var Publie_edit=new Ext.form.ComboBox({store:['Y','N']});
		var Date_edit = new Ext.form.DateField({format: 'm/d/Y'});
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var tab_news=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:store_news,
						clickstoEdit: 1,
                        columns: [
								{header: "Numero", width: 50, dataIndex: 'Num', sortable: true},
								{header: "Nom", width: 140, dataIndex: 'Nom', editor: Nom_edit , sortable: true},
								{header: "Publie", width: 140, dataIndex: 'Publie', editor: Publie_edit , sortable: true},
								{header: "Date", width: 90, dataIndex: 'Date', editor: Date_edit , sortable: true}
							],
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
						listeners: {
									afteredit: function(e){
										var conn = new Ext.data.Connection();
											conn.request({
											url: 'admin-news/news-update.php',
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
								                 var dt= new Date();
												var dat=dt.format('Y-m-d');
												var x= tab_news.getStore().getCount();
												var conn = new Ext.data.Connection();
												conn.request({
													url: 'admin-news/news-update.php',
													method:	'POST',	
													params: {
														action: 'insert',
														Nom:'New news',
														Num: x+1,
														Date:dat
													},
													success: function(resp,opt) {		
																			var x= tab_news.getStore().getCount();
																			tab_news.getStore().insert(x, new ds_model_news({Num: x+1, Nom:'New News', Publie:'', Date:dat}));
																			tab_news.startEditing(tab_news.getStore().getCount()-1,1);
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
												var sm = tab_news.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													Ext.Msg.show({
														title: 'Dopa', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Etes vous certain de vouloir supprimer '+sel.data.Nom+'?',
														fn: function(btn){
															if (btn == 'yes'){
																
																var conn = new Ext.data.Connection();
																conn.request({
																	url: 'admin-news/news-update.php',
																	params: {
																		action: 'delete',
																		Num: sel.data.Num
																	},
																	success: function(resp,opt) { 
																		tab_news.getStore().remove(sel); 
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
										store_news.load();				
									}							       	
							},'-',{
									text:'Editer',
									tooltip:'Add a new row',
									iconCls:'edit',
									handler: function () { 
										
									      		var sm = tab_news.getSelectionModel();
												var sel = sm.getSelected();
												if (sm.hasSelection()){
													var ligne=sel.data.Num ; //ligne selectione
								                    ouvre_fenetre('editor','news',ligne); //ouvre l'editeur avec les la table et l'id
												}
												else
												{
												Ext.Msg.alert('Dopa','selectioner une ligne!');
												}									
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
        var wini = desktop.getWindow('news');
        if(!wini){
            wini = desktop.createWindow({
                id: 'news',
                title:'Gestion News',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				 layout: 'fit',
                items:tab_news ,
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'bar-news',
									items: [{
										text: 'Dopa Home',
										tooltip:'Aller sur le site',
										iconCls:'dopa',
										handler: function()	{
													window.open('http://evansofts.com');
												}
										}, '-',    new Date().format('n/d/Y')]
								})
				//[tab_news,top] pour encapsuler
            });
			var mask_news = new Ext.LoadMask(Ext.get('news'), {store:store_news,msg:'Chargement...'});
			store_news.load();
        }
        wini.show();
    }
		
});

