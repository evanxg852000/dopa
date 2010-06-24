MyDesktop.rss = Ext.extend(Ext.app.Module, {
    id:'rssnews',
    init : function(){
        this.launcher = {
            text: 'rss',
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
			url: 'rssnews.php',
			reader: new Ext.data.JsonReader({
				root:'rows',
				id:'id'
			},ds_model )
	    });
	 //fin instance 			

	// variable edition du grid
		var Num_edit = new Ext.form.TextField();
		var Titre_edit = new Ext.form.TextField();
		var Lien_edit = new Ext.form.TextField();
		var Description_edit = new Ext.form.TextField();
		var Date_edit = new Ext.form.DateField({format: 'm/d/Y'});
	// dessin du grid (contenu de la fenetre) de la fenetre	
		var gride=  new Ext.grid.EditorGridPanel({
                        border:false,
					    store:sto,
						clickstoEdit: 1,
						sm: new Ext.grid.RowSelectionModel({singleSelect: true}),
                        columns: [
								{header: "Numero", width: 50, dataIndex: 'Num', editor: Num_edit , sortable: true},
								{header: "Titre", width: 140, dataIndex: 'Titre', editor: Titre_edit , sortable: true},
								{header: "Lien", width: 140, dataIndex: 'Lien', editor: Lien_edit , sortable: true},
								{header: "Description", width: 200, dataIndex: 'Description', editor: Description_edit , sortable: true},
								{header: "Date", width: 90, dataIndex: 'Date', editor: Date_edit , sortable: true}
							],
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
												gride.getStore().insert(gride.getStore().getCount(), new ds_model({Num: x+1, Titre:'', Lien:'', Description:'' , Date:''}));
												gride.startEditing(gride.getStore().getCount()-1,0);
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
														title: 'Remove Movie', 
														buttons: Ext.MessageBox.YESNOCANCEL,
														msg: 'Remove '+sel.data.Titre+'?',
														fn: function(btn){
															if (btn == 'yes'){
																 gride.getStore().remove(sel);
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
								info();				
							}//info() est defini dans divers/function
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
                title:'rss',
                width:740,
                height:480,
                iconCls: 'icon-grid',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
                layout: 'fit',
                items: gride	//encapsulation du gride dans la fenetre 
            });
			sto.load();
        }
        win.show();
    }
});

