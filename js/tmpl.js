$( document ).ready(function() {
	easyloader.locale = 'fr';
	$('#recette').datagrid ({
		url:'php/getReceipts.php',
        toolbar:'#tbar',
        striped:true,
        pagination:true,
        pageSize:20,
        pageList:[20,25,30,35],
        rownumbers:true,
        fitColumns:true,
        singleSelect:true,
        onDblClickRow : fns.editReceipts,
        columns:[[
	        {field:'nRecu',title:'Reçu N°',width:80,align:'center',fixed:true},
	        {field:'dateRecu',title:'Date de Reçu',width:180,align:'center',fixed:true},
	        // {field:'rubrique',title:'Désignation',width:300,align:'left'},
	        // {field:'nature',title:'Nature',width:300,align:'left'},
	        {field:'client',title:'Categorie/Client',width:200,align:'left'},
	        //{field:'mtn',title:'Montant de Recette',width:100,align:'right'},
	        {field:'mtnGlobal',title:'Montant Global',width:120,align:'right',fixed:true}
	    ]]
	});

	$('#nature').combobox ({
		url:'php/getNature.php',
        method:'get',
        valueField:'nNature',
        textField:'nature',
        panelHeight:'auto',
        required:true,
        onSelect: function(rec) {
            var url = 'php/getRubrique.php?nNature='+rec.nNature;
            $('#rubrique').combobox('clear');
            $('#rubrique').combobox('reload', url);
        }
	});
	$('#rubrique').combobox ({
		valueField:'nRubrique',
        textField:'rubrique',
        required:true,
        panelHeight:'auto'
	});

	$('#detaildg').datagrid ({
		url:'php/getIncomes.php',
		title:'Détail de Recettes',
        singleSelect:'true',
        fitColumns:true,
        striped:true,
        showFooter:true,
        rownumbers:true,
        toolbar:[{
            text:'Supprimer',
            iconCls:'icon-remove',
            handler: fns.removeIncome
        },'-'],
        columns:[[
        	{field:'nOperation',title:'Operatio ID',width:20,align:'center',hidden:true},
        	{field:'nNature',title:'Nature ID',width:20,align:'center',hidden:true},
        	{field:'nRubrique',title:'Rubrique ID',width:20,align:'center',hidden:true},
        	{field:'rubrique',title:'Rubrique',width:200,align:'left'},
            {field:'mtn',title:'Montant',width:50,align:'right'}
        ]],
        onClickRow: function(idx, row){
        	$('#fm').form('load',row);
        	$('#nature').combobox('select', row.nNature);
        	$('#rubrique').combobox('select', row.nRubrique);
        	
        }
	});
});