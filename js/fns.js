$( document ).ready (function() {
	var url;
	fns = {
		onDblClickRow: function (index, data) {
           	alert("It's Clicked");
    	},
    	newReceipts: function (){
	        $('#dlg').dialog('open').dialog('setTitle','Ajouter de Recettes');
	        $('#fm').form('clear');
	        $('#detaildg').datagrid('loadData',[]);
	        url = 'php/saveIncome.php';
	        // alert(JSON.stringify($('#recette').datagrid('getData')));
	    },
	    editReceipts: function (){
	        var row = $('#recette').datagrid('getSelected');
	        if (row){
	            $('#dlg').dialog('open').dialog('setTitle','Modifier de Recette');
	            $('#fm').form('load',row);
	            $('#addRub span span').text('Enregistrer');
	            $('#detaildg').datagrid ('load', {
	            	nRecu: row.nRecu
	            });
	        }
	    },
	    saveIncome: function (){
	        $('#fm').form('submit',{
	            url: url,
	            onSubmit: function(){
	                return $(this).form('validate');
	            },
	            success: function(result){
	                alert ('ccc');
	                var result = eval('('+result+')');
	                if (result.errorMsg){
	                    $.messager.show({
	                        title: 'Error',
	                        msg: result.errorMsg
	                    });
	                } else {
	                    $('#dlg').dialog('close');        // close the dialog
	                    $('#recette').datagrid('reload');    // reload the user data
	                }
	            }
	        });
	    },
	    removeReceipts: function (){
	        var row = $('#recette').datagrid('getSelected');
	        if (row){
	            $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
	                if (r){
	                    $.post('php/remove_user.php',{id:row.id},function(result){
	                        if (result.success){
	                            $('#recette').datagrid('reload');    // reload the user data
	                        } else {
	                            $.messager.show({    // show error message
	                                title: 'Error',
	                                msg: result.errorMsg
	                            });
	                        }
	                    },'json');
	                }
	            });
	        }
	    },
	    addRubrique: function () {
	        var data = $('#detaildg').datagrid('getData');
	        var footer = $('#detaildg').datagrid('getFooterRows');
	        var mtnGlobal = footer ? (parseFloat(footer[0].mtn) + parseFloat($('#mtn').numberbox('getValue'))).toFixed(2) : $('#mtn').numberbox('getValue');
	        var count = data.rows.length;
	        var nOperation = $('#nOperation').val();
	        if ($('#fm').form('validate')) {
	            if (count > 0) {
	                if($('#nOperation').val() && $('#nOperation').val() != null && $('#nOperation').attr('value') != '') {
	                	var montant = 0;
	                	$.each(data.rows, function(idx, val){
	                		if(val.nOperation == nOperation) {
	                			val.nNature = $('#nature').combobox('getValue');
								val.nRubrique = $('#rubrique').combobox('getValue');
								val.rubrique = $('#rubrique').combobox('getText');
								val.mtn = $('#mtn').numberbox('getValue');
	                		}
	                		montant = (parseFloat(val.mtn) + parseFloat(montant)).toFixed(2);
	                	})
	                	mtnGlobal = montant;
	                } else {
	                	count++;
	                	data.rows.push({
		                    nOperation: count,
		                    nRubrique: $('#rubrique').combobox('getValue'),
		                    nNature: $('#nature').combobox('getValue'),
		                    rubrique: $('#rubrique').combobox('getText'),
		                    mtn: $('#mtn').numberbox('getValue')
		                });
		                data.total = count;
	                }
	                
		            data.footer[0].mtn = mtnGlobal;
	                $('#detaildg').datagrid('loadData', data);
	            } else {
	                $('#detaildg').datagrid('loadData',{"total":1, "rows":[{
		                    nOperation: 1,
		                    nRubrique: $('#rubrique').combobox('getValue'),
		                    nNature: $('#nature').combobox('getValue'),
	                        rubrique: $('#rubrique').combobox('getText'),
	                        mtn: $('#mtn').numberbox('getValue')
	                    }], "footer":[{
	                        rubrique: "Total: ",
	                        mtn: $('#mtn').numberbox('getValue')
	                    }]
	                });
	            };
	            $('#subfm').find('input').val('');
	        }
	    },
	    removeIncome: function (){
	        var row = $('#detaildg').datagrid('getSelected');
	        if (row){
	            $.messager.confirm('Confirm','Voulez vous vraiment supprimer cet enregistrement?', function(r){
	                if (r) {
	                	var idx = $('#detaildg').datagrid('getRowIndex', row);
	                    $('#detaildg').datagrid('deleteRow', idx);

	                    var footer = $('#detaildg').datagrid('getFooterRows');
	        			var mtnGlobal = (parseFloat(footer[0].mtn) - parseFloat(row.mtn)).toFixed(2);

	        			var data = $('#detaildg').datagrid('getData');
	            		data.footer[0].mtn = mtnGlobal;
	                	$('#detaildg').datagrid('loadData', data);

	                	$('#subfm').find('input').val('');
	                }
	            });
	        } else {
	        	$.messager.alert('Information','Veuillez-vous selectionner un enregistrement.','info');
	        }
	    },
	    onLoadSuccess: function (data) {
	        var merges = [];
	        $.ajax( "php/mergeCells.php").done(function(dt) {
	            var dtMerge = $.parseJSON(dt);
	            for (var i = 0; i < dtMerge.length; i++) {
	                var item = dtMerge[i];
	                if (parseInt(item.count) > 1) {
	                    merges.push({index:i, rowspan:item.count});
	                }
	            };

	            for(var i=0; i<merges.length; i++){
	                $('#recette').datagrid('mergeCells',{
	                    index: merges[i].index,
	                    field: 'nRecu',
	                    rowspan: merges[i].rowspan
	                });
	                $('#recette').datagrid('mergeCells',{
	                    index: merges[i].index,
	                    field: 'mtnGlobal',
	                    rowspan: merges[i].rowspan
	                });
	                $('#recette').datagrid('mergeCells',{
	                    index: merges[i].index,
	                    field: 'client',
	                    rowspan: merges[i].rowspan
	                });
	            }
	        })
	    },
	    onClose: function () {
	        $('#fm').form('clear');
	        $('#detaildg').datagrid('loadData',[]);
	        $('#detaildg').datagrid('reloadFooter',[{rubrique:'Total:', mtn: 0}]);
	        $('#addRub span span').text('Ajouter');
	    }
	}
});