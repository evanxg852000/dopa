MyDesktop = new Ext.app.App({
	init :function(){
		Ext.QuickTips.init();
		horloge(); //divers hologe.js
		chargement();
		load_stats();//recupere le contenu des statistique
	    get_num();//recupere l'id du connecte pour les operations
		get_max_size_upload(); //recupere la taille maxi d'upload
	},

	getModules : function(){
		return [
			new MyDesktop.MenuDeroulantModule(),
			new MyDesktop.IPbloc(),
			new MyDesktop.News(),
            new MyDesktop.Articles(),
			new MyDesktop.Categories(),
			new MyDesktop.Menu(),
			new MyDesktop.Rss(),
			new MyDesktop.Plugins(),
			new MyDesktop.Editor(),
			new MyDesktop.Installer(),
			new MyDesktop.Users(),
			new MyDesktop.CONFG_Editor()
			// tout type de fenetre ajoute doit etre repertorier
		];
	},

    // config for the start menu
    getStartConfig : function(){
        return {
            title: 'Dopa admin',
            iconCls: 'user',
			Items: [{
                text: 'Grid Window',
 		        iconCls:'icon-grid',
 		        handler : this.createWindow,
 		        scope: this
                 }]
			,
            toolItems: [{
                text:'Appercu',
                iconCls:'view',
				handler:function (){window.open('../index.php');},
                scope:this
				},'-',{
                text:'Configuration',
                iconCls:'settings',
				handler:function (){openconfig();},
                scope:this
            },'-',{
                text:'Deconnecxion',
                iconCls:'connect',
				handler:function (){document.location.href='deconnection.php';},
                scope:this
            }]
        };
    }
});



