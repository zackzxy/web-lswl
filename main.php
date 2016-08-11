<include file="include:head" />
<script type="text/javascript">
var mainTabs
var mainAcc
var mainTree = {}
var left_menu = []
$(function() {
	//htgl_left_menu = htgl_left_menu()
	$('#passwordDialog').show().dialog({
			modal : true,
			closable : true,
			iconCls : 'ext-icon-lock_edit',
			buttons : [ {
				text : '修改',
				handler : function() {
					if ($("#mod_user_password").form('validate')) {
						$.post('../function/jsonDataClass.asp', $("#mod_user_password").serialize(), function(data) {
							if (data.result) {
								$.messager.alert('提示', '密码修改成功！', 'info');
								$('#passwordDialog').dialog('close');
							}
						}, 'json');
					}
				}
			} ],
			onOpen : function() {
				$('#mod_user_password input[type=\'password\']').val('');
			}
		}).dialog('close');
	mainTree.system = $("#system_tree").tree({
				data: [
					{text: '登陆用户',iconCls:'ext-icon-user_go',	attributes:{'url':'../loguser/loginUserList'}},
					{text: '会员管理',iconCls:'ext-icon-user_go',	attributes:{'url':'../member/memberList'}},
					{text: '机构管理',iconCls:'ext-icon-user_gray',attributes:{'url':'../organization/organizationList'}},
					{text: '机构会员',iconCls:'ext-icon-book_previous',attributes:{'url':'../organization/organization_member_List'}},
					{text: '信息管理',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../message/messageList'}},
					{text: '登录日志',iconCls:'ext-icon-script',attributes:{'url':'../logs/loginLogs'}},
					{text: '系统日志',iconCls:'ext-icon-database',attributes:{'url':'../logs/systemLogs'}}
				],
				onClick: function(node){
					if (mainTabs.tabs('exists',node.text)){
						mainTabs.tabs('select',node.text)
					}
					else{console.log(node)
						mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
					}
				}

		});	
	mainTree.event = $("#event_tree").tree({
				data : [
					{text: '赛事列表',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../event/eventList'}},
					{text: '赛事组别',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../eventGroup/eventGroupList'}},
					{text: '参赛名单',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../participants/personalList'}},
					//{text: '赛事公告',iconCls:'ext-icon-folder_page_white',attributes:{'url':'Notice/eventNoticeList'}},
					{text: '赛事收藏',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../favorite/favoriteList'}},
					{text: '报名人员',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../entryName/entryNameList'}},
					{text: '比赛结果',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../event/eventResult'}}
				],
				onClick: function(node){
					if (mainTabs.tabs('exists',node.text)){
						mainTabs.tabs('select',node.text)
					}
					else{
						mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
					}
				}
		});
	mainTree.news = $("#news_tree").tree({
				data : [
					{text: '赛事公告',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../Notice/eventNoticeList'}},
					{text: '赛事新闻',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../News/eventNewsList'}},
					{text: '公司新闻',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../News/CompanyNewsList'}}
				],
				onClick: function(node){
					if (mainTabs.tabs('exists',node.text)){
						mainTabs.tabs('select',node.text)
					}
					else{
						mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
					}
				}
		});	
	mainTree.other = $("#grgl_tree").tree({
		data : [
					//{text: '报名条件',iconCls:'ext-icon-folder_page_white',attributes:{'url':'conditionList'}},
					//{text: '相关费用',iconCls:'ext-icon-folder_page_white',attributes:{'url':'costList'}},
					//{text: '相关奖金',iconCls:'ext-icon-folder_page_white',attributes:{'url':'PrizeList'}},
					//{text: '组别评论',iconCls:'ext-icon-folder_page_white',attributes:{'url':'commentList'}},
					
					//{text: '公告管理',iconCls:'ext-icon-application',attributes:{'url':'noticeList'}},
					
				],
				onClick: function(node){
					if (mainTabs.tabs('exists',node.text)){
						mainTabs.tabs('select',node.text)
					}
					else{
						mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
					}
				}
	});
	mainTree.finance = $("#fin_tree").tree({
		data : [
			{text: '提现',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../Finance/withdrawsCash'}},
			{text: '绑定银行卡',iconCls:'ext-icon-folder_page_white',attributes:{'url':'../Finance/bankCardBind'}},
		],
		onClick: function(node){
			if (mainTabs.tabs('exists',node.text)){
				mainTabs.tabs('select',node.text)
			}
			else{
				mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
			}
		}
	});
	mainTree.operation = $("#operation_tree").tree({
		data : [
			{text: '1',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
			{text: '2',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
			{text: '3',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
		],
		onClick: function(node){
			if (mainTabs.tabs('exists',node.text)){
				mainTabs.tabs('select',node.text)
			}
			else{
				mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
			}
		}
	});
	mainTree.management = $("#manage_tree").tree({
		data : [
			{text: '1',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
			{text: '2',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
			{text: '3',iconCls:'ext-icon-folder_page_white',attributes:{'url':''}},
		],
		onClick: function(node){
			if (mainTabs.tabs('exists',node.text)){
				mainTabs.tabs('select',node.text)
			}
			else{
				mainTabs.tabs('add',{title:node.text,closable:true,content:'<iframe src="'+node.attributes.url+'.php?userPermID='+node.attributes.permID+'" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameBorder="0"></iframe>'});
			}
		}
	});
	mainAcc = $('#mainAcc').accordion({
			fit:true,
			border:false,
			animate:false
		}).show();	
	mainTabs = $('#mainTabs').show().tabs({
			fit : true,
			border : false,
			tools : [ {
				text : '刷新',
				iconCls : 'ext-icon-arrow_refresh',
				handler : function() {
					var panel = mainTabs.tabs('getSelected').panel('panel');
					var frame = panel.find('iframe');
					try {
						if (frame.length > 0) {
							for (var i = 0; i < frame.length; i++) {
								frame[i].contentWindow.document.write('');
								frame[i].contentWindow.close();
								frame[i].src = frame[i].src;
							}
							if(navigator.userAgent.indexOf("MSIE")>0){
								//IE特有回收内存方法
								try{
									CollectGarbage();
								}catch(e){
								}
							}
						}
					} catch (e) {
					}
				}
			},{
				text : '关闭',
				iconCls : 'ext-icon-cross',
				handler : function() {
					var index = mainTabs.tabs('getTabIndex', mainTabs.tabs('getSelected'));
					var tab = mainTabs.tabs('getTab', index);
					if (tab.panel('options').closable) {
						mainTabs.tabs('close', index);
					} else {
						$.messager.alert('提示', '[' + tab.panel('options').title + ']不可以被关闭！', 'error');
					}
				}
			} ]
		}).tabs('add',{title:'关于平台',content:'<iframe src="/admin/main/defaultInfo.php" allowTransparency="true" scrolling="no" style="border: 0; width: 100%; height: 100%;" frameborder="0"></iframe>'});;
})
</script>
<title>后台管理</title>
<style>
	#mainTabs>.tabs-panels>.panel>.panel-body{
		overflow: hidden;
	}
</style>
</head>
<body class="easyui-layout">
  <div data-options="region:'north',href:'north.php'" style="height:52px;" class="logo"></div>
  <div data-options="region:'south',href:'south.php',border:false" style="height:30px;"></div>
  <div data-options="region:'west'" style="width:160px;">
  	<div id="mainAcc">
      <div title="系统设置" data-options="selected:true,iconCls:'ext-icon-cog'" style="padding:5px">  
        <ul id="system_tree"></ul>
      </div>  
      <div title="赛事管理" data-options="selected:true,iconCls:'ext-icon-folder'" style="padding:5px">  
        <ul id="event_tree"></ul>   
      </div>
      <div title="新闻管理" data-options="selected:true,iconCls:'ext-icon-folder'" style="padding:5px">  
        <ul id="news_tree"></ul>   
      </div>  
      <div title="其他管理">  
        <ul id="grgl_tree"></ul>   
      </div>
	  <div title="财务管理" data-options="selected:true,iconCls:'ext-icon-folder'" style="padding:5px">
		<ul id="fin_tree"></ul>
	  </div>
	  <div title="运维管理" data-options="selected:true,iconCls:'ext-icon-folder'" style="padding:5px">
	    <ul id="operation_tree"></ul>
	  </div>
	  <div title="管理层" data-options="selected:true,iconCls:'ext-icon-folder'" style="padding:5px">
		<ul id="manage_tree"></ul>
      </div>
  </div>
  </div>
  <div data-options="region:'center',border:false" style="overflow: hidden;background:#eee;">
    <div id="mainTabs" style="display:none">
    </div>
  </div>
</body>
</html>


