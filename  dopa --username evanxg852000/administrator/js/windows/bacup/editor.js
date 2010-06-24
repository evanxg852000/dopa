MyDesktop.Editor = Ext.extend(Ext.app.Module, {
    id:'editor',
    init : function(){
        this.launcher = {
            text: 'Editeur',
            iconCls:'editor',
            handler : this.createWindow,
            scope: this
        }
    },

    createWindow : function(){
        var desktop = this.app.getDesktop(); 
		
	function choose()
	{
    	if(!chooser){
    		chooser = new ImageChooser({
    			url:'media-test/get-images.php',
    			width:515, 
    			height:350
    		});
    	}
    	chooser.show();
    };
		
		var edit_ch=new Ext.form.HtmlEditor({
					fieldLabel:'Contenu',
					name:'edition',
					height:400,
					anchor:'98%'
				});	
  var edit_form = new Ext.FormPanel({
	    url: 'admin-edit/edit-submit.php',
        labelAlign: 'top',
        frame:true,
        title: 'Edition du news ....',
        bodyStyle:'padding:5px 5px 0',
        items:edit_ch,
        buttons: [{
            text: 'Save', //apel de ajax pour enregister
				handler: function(){
					var c=edit_form.getForm().findField('edition').getValue()
                    //Ext.Msg.alert('Warning',c );
				    var req = new Ext.data.Connection();
					 req.request({
						url: 'admin-edit/edit-submit.php',
						method:	'POST',	
						params: {
						Table: G_TABLE,
						Num: G_NUM,
						Contenu: c,  //edit_form.getForm().findField('edition').getValue(),
								},
								success: function(resp,opt) 
								                {													
													Ext.Msg.alert('Dopa',resp.responseText );		
												},
								failure: function(resp,opt)
								               {
													Ext.Msg.alert('Error','Ajout Impossible !');
												}
									});
				}
        },{
            text: 'Cancel',
			handler: function(){
			  Ext.Msg.alert('test',G_TABLE);
			 }	 	
        },{
			 text: 'Image',
			 handler: function(){
			  window.open('../media/image_view.php', 'viewer', 'width=550,height=480,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no')
			 }	 
		}]
    });
    
	var req = new Ext.data.Connection();
		     req.request({
				url: 'admin-edit/edit.php',
				method:	'POST',	
				params: {
				Table: G_TABLE,
				Num: G_NUM,
						},
						success: function(resp,opt) {													
													var contenu=resp.responseText;
													edit_form.getForm().findField('edition').setValue(contenu);
													},
													failure: function(resp,opt) {
													Ext.Msg.alert('Error','Ajout Impossible !');
													}
							});
		
        var wini = desktop.getWindow('editor');
        if(!wini){
            wini = desktop.createWindow({
                id: 'editor',
                title:'Editeur',
                width:740,
                height:480,
                iconCls: 'editor',
                shim:false,
                animCollapse:false,
                constrainHeader:true,
				layout: 'fit',
				items:edit_form

            });
        }
        wini.show();
    }
		
});
//renommer les articles et activer/desact
//ajouter un nouv menu
