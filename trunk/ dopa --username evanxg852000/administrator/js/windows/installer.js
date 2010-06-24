MyDesktop.Installer = Ext.extend(Ext.app.Module, {
    id:'installer',
    init : function(){
        this.launcher = {
            text: 'Gestion Installer',
            iconCls:'installer',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop();	
		
		var installer_form = new Ext.FormPanel({
	    url: 'installer/installer.php',
        labelAlign: 'top',
		fileUpload: true,
        frame:true,
        title: 'installation ....',
        bodyStyle:'padding:5px 5px 0',
        items:[{
			xtype:'hidden',
			id: 'file_size_max',
			name:'MAX_FILE_SIZE',
			value:G_MAX_FILE_SIZE,
			anchor:'95%'
			},{
            xtype: 'fileuploadfield',
            id: 'install-package',
            emptyText: 'Selectionner le package',
			allowBlank :false,
			blankText: 'Ce champ est obligatoire',
            fieldLabel: 'Fichier zip',
            name: 'fichier[]',
			anchor: '95%',
            buttonCfg: {
                text: '',
                iconCls: 'package'
            }
        }],
        buttons: [{
            text: 'installer', //apel de ajax pour enregister
				handler: function(){
						installer_form.getForm().submit({
						waitMsg: 'Installation en cours...',
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
        }]
    });

var image_uploader_form = new Ext.FormPanel({
	    url: 'installer/image-upload.php',
        labelAlign: 'top',
        frame:true,
		fileUpload: true,
		autoHeight: true,
        title: 'Uploder images ',
        bodyStyle:'padding:5px 5px 0',
        items: [{
			xtype:'hidden',
			name:'MAX_FILE_SIZE',
			value:G_MAX_FILE_SIZE,
			anchor:'95%'
			},{
					xtype:'combo',
                    fieldLabel: 'Repertoire',
					allowBlank :false,
					blankText: 'Ce champ est obligatoire',
                    name: 'repertoire',
				    triggerAction: 'all',
					editable: false,
					store: ['album','banner','icons','images']
			},{
            xtype: 'fileuploadfield',
            id: 'form-file',
            emptyText: 'Selectionner une image',
			allowBlank :false,
			blankText: 'Ce champ est obligatoire',
            fieldLabel: 'Image',
            name: 'fichier[]',
			anchor: '95%',
            buttonCfg: {
                text: '',
                iconCls: 'upload-icon'
            }
        }],
        buttons: [{
            text: 'uploader', //apel de ajax pour enregister
				handler: function(){
						image_uploader_form.getForm().submit({
						waitMsg: 'Upload en cours...',
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
        },{
            text: 'Cancel',
			handler: function(){
			  Ext.Msg.alert('Dopa','Fermer cete fenetre');
			 }	 	
        }]
    });
    

        var wini = desktop.getWindow('installer');
        if(!wini){
            wini = desktop.createWindow({
                id: 'installer',
                title:'Gestion Installer',
                width:440,
                height:330,
                iconCls: 'installer',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				items:[installer_form,image_uploader_form]
            });
        }
        wini.show();
    }
		
});

