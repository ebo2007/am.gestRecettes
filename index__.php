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
    <script type="text/javascript" src="lib/easyloader.js"></script>
    <script type="text/javascript">
        $('document').ready(function() {
           easyloader.locale = 'fr';
        });
    </script>
</head>
<body>
    <div id="tt" class="easyui-tabs" tabPosition="left" tabHeight="40" >
        <div title="Gestion de Recettes" style="padding:10px; height:97.9% !important;">            
            <table id="grid" class="easyui-datagrid" title="Group Rows in DataGrid" style="width:auto;"
                    data-options="
                        singleSelect:true,
                        collapsible:false,
                        rownumbers:true,
                        fitColumns:true,
                        data:data,
                        view:groupview,
                        groupField:'productid',
                        groupFormatter:function(value, rows){
                            return value + ' - ' + rows.length + ' Item(s)';
                        }
                    ">
                <thead>
                    <tr>
                        <th data-options="field:'itemid',width:80">Item ID</th>
                        <th data-options="field:'productid',width:100">Product</th>
                        <th data-options="field:'listprice',width:80,align:'right'">List Price</th>
                        <th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
                        <th data-options="field:'attr1',width:250">Attribute</th>
                        <th data-options="field:'status',width:60,align:'center'">Status</th>
                    </tr>
                </thead>
            </table>
            <script type="text/javascript">
                var data = [
                    {"productid":"FI-SW-01","productname":"Koi","unitcost":10.00,"status":"P","listprice":36.50,"attr1":"Large","itemid":"EST-1"},
                    {"productid":"K9-DL-01","productname":"Dalmation","unitcost":12.00,"status":"P","listprice":18.50,"attr1":"Spotted Adult Female","itemid":"EST-10"},
                    {"productid":"RP-SN-01","productname":"Rattlesnake","unitcost":12.00,"status":"P","listprice":38.50,"attr1":"Venomless","itemid":"EST-11"},
                    {"productid":"RP-SN-01","productname":"Rattlesnake","unitcost":12.00,"status":"P","listprice":26.50,"attr1":"Rattleless","itemid":"EST-12"},
                    {"productid":"RP-LI-02","productname":"Iguana","unitcost":12.00,"status":"P","listprice":35.50,"attr1":"Green Adult","itemid":"EST-13"},
                    {"productid":"FL-DSH-01","productname":"Manx","unitcost":12.00,"status":"P","listprice":158.50,"attr1":"Tailless","itemid":"EST-14"},
                    {"productid":"FL-DSH-01","productname":"Manx","unitcost":12.00,"status":"P","listprice":83.50,"attr1":"With tail","itemid":"EST-15"},
                    {"productid":"FL-DLH-02","productname":"Persian","unitcost":12.00,"status":"P","listprice":23.50,"attr1":"Adult Female","itemid":"EST-16"},
                    {"productid":"FL-DLH-02","productname":"Persian","unitcost":12.00,"status":"P","listprice":89.50,"attr1":"Adult Male","itemid":"EST-17"},
                    {"productid":"AV-CB-01","productname":"Amazon Parrot","unitcost":92.00,"status":"P","listprice":63.50,"attr1":"Adult Male","itemid":"EST-18"},
                    {"productid":"FL-DSH-01","productname":"Manx","unitcost":12.00,"status":"P","listprice":158.50,"attr1":"Tailless","itemid":"EST-14"},
                    {"productid":"FL-DSH-01","productname":"Manx","unitcost":12.00,"status":"P","listprice":83.50,"attr1":"With tail","itemid":"EST-15"},
                    {"productid":"FL-DLH-02","productname":"Persian","unitcost":12.00,"status":"P","listprice":23.50,"attr1":"Adult Female","itemid":"EST-16"},
                    {"productid":"FL-DLH-02","productname":"Persian","unitcost":12.00,"status":"P","listprice":89.50,"attr1":"Adult Male","itemid":"EST-17"},
                    {"productid":"AV-CB-01","productname":"Amazon Parrot","unitcost":92.00,"status":"P","listprice":63.50,"attr1":"Adult Male","itemid":"EST-18"}
                ];
            </script>
        </div>
        <div title="Gestion de Versements" style="padding:10px; height:97.9% !important;">
            <!-- <ul class="easyui-tree" data-options="url:'tree_data1.json',method:'get',animate:true"></ul> -->
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
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Enregistrer</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Annuler</a>
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
            </script>
            <style type="text/css">
                #fm{
                    margin:0;
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
                .fitem{
                    margin-bottom:5px;
                }
                .fitem label{
                    display:inline-block;
                    width:80px;
                }
            </style>
        </div>
        <div title="Help" data-options="iconCls:'icon-help',closable:false" style="padding:10px; height:97.9% !important;">
            This is the help content.
        </div>
    </div>
 
</body>
</html>