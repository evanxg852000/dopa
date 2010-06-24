function Media(){
        var desktop = this.app.getDesktop();

		var thumbTemplate = new Ext.XTemplate(
			'<tpl for=".">',
				'<div class="thumb-wrap" id="{name}">',
				'<div class="thumb"><img src="{url}" title="{name}"></div>',
				'<span>{name}</span></div>',
			'</tpl>'
		);
		thumbTemplate.compile();
		
		store = new Ext.data.JsonStore({
			    url:'admin-medias/Get-Images.php',
			    root: 'images',
			    fields: [
			        'name', 'url',
			        {name:'size', type: 'float'},
			        {name:'lastmod', type:'date', dateFormat:'timestamp'}
			    ],
			    listeners: {
			    	'load': {fn:function(){ view.select(0); },single:true}
			    }
			});
			var dir='../media/image';
			  store.load({
					params: {
					Repertoire: dir
						}
						});
		//	store.load();
					
			
		    view = new Ext.DataView({
				tpl:thumbTemplate,
				singleSelect: true,
				loadingText:'Chargement...',
				overClass:'x-view-over',
				itemSelector: 'div.thumb-wrap',
				emptyText : '<div style="padding:10px;">Aucune  images ne correspond a ce filtre</div>',
				store: store,
				listeners: {
					'selectionchange': {fn:DefinirCode, scope:this, buffer:100},
				},
			});
		
		function Lister_repertoire() {
			var dir= Ext.getCmp('changerep').getValue();
			//store.baseParams ={	Repertoire:dir};
				 store.reload({
					params: {
					  Repertoire: dir
					}
				  });
				view.refresh();
				//Ext.Msg.alert('Error',dir);
		};
		
		
	function DefinirCode (){
		var selNode =view.getSelectedNodes();
	    selNode = selNode[0];
		var d = Ext.getCmp('chemin').setValue('<img src="media/images/'+selNode.id+'"/>');
	};
		
	function filter(){
		var filter = Ext.getCmp('filter');
		view.store.filter('name', filter.getValue());
		view.select(0);
	};
	
	 function sortImages(){
		var v = Ext.getCmp('sortSelect').getValue();
    	view.store.sort(v, v == 'name' ? 'asc' : 'desc');
    	view.select(0);
    };
	
        var wini = desktop.getWindow('mediaview');
        if(!wini){
            wini = desktop.createWindow({
                id: 'mediaview',
                title:'Media',
                width:575,
                height:380,
                iconCls: 'mediaview',
                shim:false,
				maximizable: false,
				resizable : false,
                animCollapse:false,
                constrainHeader:true,
				layout: 'border',
				border: false,
				items:[{
					id: 'img-chooser-view',
					region: 'center',
					autoScroll: true,
					items:view,
                    tbar:[{
                    	text: 'Filter:'
                    },{
                    	xtype: 'textfield',
                    	id: 'filter',
                    	selectOnFocus: true,
                    	width: 65,
						listeners: {
                    		'render': {fn:function(){
						    	Ext.getCmp('filter').getEl().on('keyup', function(){
						    		filter();
						    	});
                    		}}
                    	}
                     }, ' ', '-', {
                    	text: 'Trier:'
                    }, {
                    	id: 'sortSelect',
                    	xtype: 'combo',
				        typeAhead: true,
				        triggerAction: 'all',
				        width: 70,
				        editable: false,
				        mode: 'local',
				        displayField: 'desc',
				        valueField: 'name',
				        lazyInit: false,
				        value: 'name',
				        store: new Ext.data.SimpleStore({
					        fields: ['name', 'desc'],
					        data : [['name', 'Name'],['size', 'File Size'],['lastmod', 'Last Modified']]
					    }),
						   listeners: {
							'select': {fn:sortImages, scope:this}
					    }
				    },{
						text: 'Code:'
						},{
					   	xtype: 'textfield',
                    	id: 'chemin',
                    	selectOnFocus: true,
                    	width: 160
						},'-',{
							text:'Rep:'
							},{
                    	id: 'changerep',
                    	xtype: 'combo',
				        typeAhead: true,
				        triggerAction: 'all',
				        width: 80,
				        editable: false,
				        mode: 'local',
				        lazyInit: false,
				        value: 'name',
				        store: ['album','banner','icons','images'],
						   listeners: {
							'select': {fn:Lister_repertoire, scope:this}
					    }
					
					}]
				}],
				bbar: new Ext.StatusBar({
									defaultText: 'Dopa V0.3',
									id: 'media-view',
									items: [{
										text: 'Dopa Home',
										tooltip:'Aller sur le site',
										iconCls:'dopa',
										handler: function()	{
											var dir= Ext.getCmp('changerep').getValue();
											var s = view.getStore()
												//store.baseParams ={	Repertoire:dir};
													 s.reload({
														params: {
														  Repertoire: dir
														}
													  });
													view.refresh();
													//window.open('http://evansofts.com');
												}
										}, '-',    new Date().format('n/d/Y')]
								})
            });
        }
        wini.show();
    }