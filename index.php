<html>
<head>
    <meta charset="UTF-8">
    <title>Tab Position - jQuery EasyUI Demo</title>
    <link rel="stylesheet" type="text/css" href="lib/themes/gray/easyui.css">
    <link rel="stylesheet" type="text/css" href="lib/themes/icon.css">
    <!-- <link rel="stylesheet" type="text/css" href="../demo.css"> -->
    <script type="text/javascript" src="lib/jquery.min.js"></script>
    <script type="text/javascript" src="lib/jquery.easyui.min.js"></script>    
    <script type="text/javascript" src="lib/extensions/datagrid-groupview.js"></script>
    <script type="text/javascript" src="lib/extensions/datagrid-detailview.js"></script>
    <script type="text/javascript" src="lib/easyloader.js"></script>
    <script type="text/javascript" src="js/json2.js"></script>
    <script type="text/javascript" src="js/fns.js"></script>
    <script type="text/javascript" src="js/tmpl.js"></script>
    <!--<script type="text/javascript" >
        $( document ).ready (function() {
            easyloader.locale = 'fr';
        });
    </script>-->
</head>
<body>
    <div id="tt" class="easyui-tabs" tabPosition="left" tabHeight="40" >
        <div title="Gestion de Recettes" style="padding:10px 120px; height:97.9% !important;">            
            <table id="recette" title="Gestion de Recettes" class="easyui-datagrid" style="width:auto;height:auto;max-height:364px !important;"></table>
            <div id="tbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="fns.newReceipts()">Ajouter </a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="fns.editReceipts()">Modifier</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="fns.destroyIncome()">Supprimer</a>
            </div>            
            <div id="dlg" class="easyui-dialog" style="width:650px;height:630px;padding:10px 20px;" closed="true" buttons="#dlg-buttons" data-options="onClose:fns.onClose, modal:true">
                <div class="ftitle">Informations de Recettes</div>
                <form id="fm" method="post" novalidate>
                    <div class="pitem">
                        <div class="fitem">
                            <label>N° de Reçu:</label>
                            <input name="nRecu" class="easyui-validatebox" style="width:100px;"  required="true">
                            <label style="padding-left:95px;">Date de Reçu:</label>
                            <input name="dateRecu" class="easyui-datebox"  style="width:100px"  required="true">
                        </div>
                        <div class="fitem">
                            <label>Catégorie/Client:</label>
                            <input name="client" class="easyui-validateboxx" required="false">
                        </div>
                    </div>
                    <div id="subfm">
                        <div class="fitem">
                            <label>Nature:</label>
                            <input id="nature" name="nature" style="width:395px" class="easyui-combobox">
                        </div>
                        <div class="fitem">
                            <label>Rubrique:</label>
                            <input id="rubrique" name="rubrique" style="width:395px" class="easyui-combobox">
                        </div>
                        <div class="fitem">
                            <!-- <label>Quantité:</label> -->
                            <input id="nOperation" name="nOperation" type="hidden">
                            <label>Montant:</label>
                            <input id="mtn" name="mtn" class="easyui-numberbox" style="width:100px" data-options="required:true,precision:2,decimalSeparator:'.'">
                        </div>
                        <div class="fitem">
                            <a id="addRub" href="javascript:void(0)" class="easyui-linkbutton" style="margin-left:390px;" onclick="fns.addRubrique()" data-options="iconCls:'icon-add'">Ajouter</a>
                        </div>
                    </div>
                                       
                </form>
                <table id="detaildg" class="easyui-datagrid" style="width:auto;height:280px;" ></table>
            </div>
            <div id="dlg-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="fns.saveIncome()">Valider</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Annuler</a>
            </div>
            <script type="text/javascript">
                
            </script>    
        </div>
        <div title="Gestion de Versements" style="padding:10px; height:97.9% !important;">
            <!-- <ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true"></ul> 
            <table id="dg" title="My Users" class="easyui-datagrid" style="width:auto;height:auto;max-height:364px !important;"
                    url="php/get_users.php"
                    toolbar="#toolbar" pagination="true" pageList="[10,15,20,25]"
                    rownumbers="true" fitColumns="true" singleSelect="true">
                <thead>
                    <tr>
                        <th field="firstname" width="50">First Name</th>
                        <th field="lastname" width="50">Last Name</th>
                        <th field="phone" width="50">Phone</th>
                        <th field="email" width="50">Email</th>
                    </tr>
                </thead>
            </table>
            <div id="toolbar">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
            </div>
            
            <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px;"
                    closed="true" buttons="#dlg-buttons">
                <div class="ftitle">User Information</div>
                <form id="fm" method="post" novalidate>
                    <div class="fitem">
                        <label>First Name:</label>
                        <input name="firstname" class="easyui-validatebox" required="true">
                    </div>
                    <div class="fitem">
                        <label>Last Name:</label>
                        <input name="lastname" class="easyui-validatebox" required="true">
                    </div>
                    <div class="fitem">
                        <label>Phone:</label>
                        <input name="phone">
                    </div>
                    <div class="fitem">
                        <label>Email:</label>
                        <input name="email" class="easyui-validatebox" validType="email">
                    </div>
                </form>
            </div>
            <div id="dlg-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
            </div>
            <script type="text/javascript">
                var url;
                function newUser(){
                    $('#dlg').dialog('open').dialog('setTitle','New User');
                    $('#fm').form('clear');
                    url = 'php/save_user.php';
                }
                function editUser(){
                    var row = $('#dg').datagrid('getSelected');
                    if (row){
                        $('#dlg').dialog('open').dialog('setTitle','Edit User');
                        $('#fm').form('load',row);
                        url = 'php/update_user.php?id='+row.id;
                    }
                }
                function saveUser(){
                    $('#fm').form('submit',{
                        url: url,
                        onSubmit: function(){
                            return $(this).form('validate');
                        },
                        success: function(result){
                            var result = eval('('+result+')');
                            if (result.errorMsg){
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dlg').dialog('close');        // close the dialog
                                $('#dg').datagrid('reload');    // reload the user data
                            }
                        }
                    });
                }
                function destroyUser(){
                    var row = $('#dg').datagrid('getSelected');
                    if (row){
                        $.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
                            if (r){
                                $.post('php/remove_user.php',{id:row.id},function(result){
                                    if (result.success){
                                        $('#dg').datagrid('reload');    // reload the user data
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
                }
            </script>-->
            <style type="text/css">
                *{
                    /*outline: none;*/
                    font: 12px/1.7em "Open Sans", "trebuchet ms", arial, sans-serif;
                    color: #444;
                }
                #fm{
                    margin:0 auto;
                    padding:10px 30px;
                    font-size: 13px;

                }
                .ftitle{
                    font-size:14px;
                    font-weight:bold;
                    padding:5px 0;
                    margin-bottom:10px;
                    border-bottom:1px solid #ccc;
                }
                .fitem {
                    margin-bottom:5px;
                }
                .pitem {
                    margin-bottom:15px;
                }
                .fitem label {
                    display:inline-block;
                    width:95px;
                }
                .fitem input{
                    width:395px;
                    border: 0px;
                    background: #C2D7EE;
                    padding-left:4px;
                }
            </style>
        </div>
        <div title="Help" data-options="iconCls:'icon-help',closable:false" style="padding:10px; height:97.9% !important;">
            This is the help content.
        </div>
    </div>
 
</body>
</html>