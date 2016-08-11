<include file="include:head" />
<title>登陆用户列表</title>
<script type="text/javascript">
    var bankCardBind_list_dg,search_key,checkState;
    $(function($) {
        bankCardBind_list_dg = $("#bankCardBind_list_dg").datagrid({
            url: '/admin/post',
            method:"post",
            border:false,
            idField:'id',
            fit:true,
            queryParams:{act:'bindcardlist',state:-1,pageSize:1},
            //sortName:'registerTime',
            //sortOrder:'asc',
            striped:true,
            rownumbers:true,
            pagination:true,
            singleSelect:true,
            pageSize:1,
            pageList:[1,2,3,4],
            toolbar:'#toolbar',
            onDblClickRow:showFun,
            onRowContextMenu:sy.onRowContextMenu,
            fitColumns:true,
            columns:[[
                {field:'bankcard',title:'银行卡号',width:80},
                {field:'bankname',title:'银行',width:120},
                {field:'bankmob',title:'电话',width:120},
                {field:'cardname',title:'名称',width:120},
                {field:'checkstate',title:'审核状态',width:120,formatter:function(value,row,index){
                    switch (value){
                        case '1':value='审核成功';break;
                        case '2':value='审核失败';break;
                        default:value='待审核';
                    }
                    return value;}
                }
            ]],
            onLoadSuccess : function(data){
                $(this).datagrid("unselectAll");
            }
        });
        search_key = $("#search_key").searchbox({
            searcher:function(value,name){
                $.ajax({
                    url: '/admin/post', data: {act: 'bindcardlist', pageSize: '10', state:-1, keywords: value},
                    success: function (data) {
                        if (!data.rows) {
                            alert('没有数据！')
                        }
                    }
                })
                bankCardBind_list_dg.datagrid('load',{act: 'bindcardlist', pageSize: '10', state:-1, keywords: value})
            },
            prompt:'关键字搜索'
        });
        checkState=function (obj){
            var state=$(obj).find('.menu-text').html();
            $('#for_mma').find('.l-btn-text').html(state);
            switch (state){
                case '审核失败':state=2;break;
                case '待审核':state=0;break;
                case '审核成功':state=1;break;
                default:state=-1;
            };
            $("#bankCardBind_list_dg").datagrid('reload',
                {act:'bindcardlist',pageSize:'5',state:state}
            )
        }
    });
    function showFun(rowIndex, rowData)  {
        var dialog = parent.sy.modalDialog({
            title : '登录用户信息',
            url : '/admin/Finance/bankCardBindInfo.php?id='+rowData.id,
            height:400,
            buttons : [
                {text : '关闭',handler : function() {dialog.dialog('destroy');}}
            ]
        });
    };
    var editFun = function() {
        if(sy.dg_getRowData(bankCardBind_list_dg)==null){
            parent.$.messager.alert('警告','没有选择需要修改的数据');
        }
        else{
            var rowData = sy.dg_getRowData(bankCardBind_list_dg);
            var index = bankCardBind_list_dg.datagrid('getRowIndex',rowData);
            var dialog = parent.sy.modalDialog({
                title : '修改登录用户信息',
                url : '../Finance/bankCardBindForm.php?id='+rowData.id,
                height:200,
                buttons : [{
                    text : '编辑',
                    handler : function() {
                        dialog.find('iframe').get(0).contentWindow.submitForm(dialog, bankCardBind_list_dg, parent.$);
                    }
                }]
            });
        }
    };
    function showMessage(){
        var rowData =sy.dg_getRowData(bankCardBind_list_dg);
        if(rowData==null){
            parent.$.messager.alert('警告','没有选择需要的数据');
        }else{
            var dialog = parent.sy.modalDialog({
                title : '会员消息信息',
                url : '/admin/Finance/bankCardBindInfo.php?id=' + rowData.id,
                height:500,
                buttons : [{text:'关闭',handler:function(){dialog.dialog('destroy');}}]
            });
        }
    }
</script>
<style>
    .state-accept{
        background: url('/__PUBLIC__/syExt/style/images/state-accept.png') no-repeat center center;
    }
    .state-all{
        background: url('/__PUBLIC__/syExt/style/images/state-all.png') no-repeat center center;
    }
    .state-fail{
        background: url('/__PUBLIC__/syExt/style/images/state-fail.png') no-repeat center center;
    }
    .state-wait{
        background: url('/__PUBLIC__/syExt/style/images/state-wait.png') no-repeat center center;
    }
</style>
</head>
<body>
<div id="toolbar" class="hide">
    <table>
        <tr>
            <td><input name="keywords" style="width:200px;" id="search_key" /></td>
            <td><a href="javascript:void(0);" class="easyui-linkbutton" data-options="iconCls:'ext-icon-zoom_out',plain:true" onClick="search_key.searchbox('setValue','');">重置搜索</a></td>
            <td>
                <a id="for_mma" href="javascript:void(0)" class="easyui-menubutton" data-options="iconCls:'ext-icon-newspaper',menu:'#mma',plain:true" >审核状态</a>
                <div id="mma">
                    <div data-options="iconCls:'state-fail'" onclick="checkState(this)">审核失败</div>
                    <div data-options="iconCls:'state-wait'" onclick="checkState(this)">待审核</div>
                    <div data-options="iconCls:'state-accept'" onclick="checkState(this)">审核成功</div>
                    <div data-options="iconCls:'state-all'" onclick="checkState(this)">全部</div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div id="onRowContextMenu" class="easyui-menu hide">
    <div data-options="iconCls:'icon-edit'" onClick="editFun()">修改</div>
    <div class="menu-sep"></div>
    <div data-options="iconCls:'icon-redo'" onClick="showMessage()">详细信息</div>
</div>
<table id="bankCardBind_list_dg" style="width: 100%;"></table>
</body>
</html>
