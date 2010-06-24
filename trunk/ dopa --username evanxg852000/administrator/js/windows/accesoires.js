MyDesktop.MenuDeroulantModule = Ext.extend(Ext.app.Module, {
    init : function(){
        this.launcher = {
            text: 'Accessoires',
            iconCls: 'bogus',
            handler: function() {
				return false;
			},
            menu: {
                items:[{
                    text: 'Template',
                    iconCls:'template',
                    handler : Template,
                    scope: this,
                    windowId: 'template'
					},{
                    text: 'Media',
                    iconCls:'media',
                    handler : Media,
                    scope: this,
                    windowId: 'mediaview'						
						},{
                    text: 'Statistique',
                    iconCls:'sondage',
                    handler : Statistique,
                    scope: this,
                    windowId: 'statistique'
                    },{
                    text: 'Messages',
                    iconCls:'message',
                    handler : Message,
                    scope: this,
                    windowId: 'message'						
					},{
                    text: 'Publicite',
                    iconCls:'publicite',
					handler : Publicite,
                    scope: this,
                    windowId: 'publicite'
                }]
            }
        }
    }
});
