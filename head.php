<?php
session_start();//开启session
header("Content-Type: text/html;charset=utf-8");
header("Cache-Control: no-cache");
//include "../../class/safe.class.php";//加载安全类
$_time = time();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-Control" content="no-cache">
<link rel="stylesheet" type="text/css" href="/__PUBLIC__/jquery-easyui-1.4.5/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="/__PUBLIC__/jquery-easyui-1.4.5/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="/__PUBLIC__/syExt/style/syExtIcon.css" />
<link rel="stylesheet" type="text/css" href="/__PUBLIC__/syExt/style/syExtCss.css?t=<?php echo $_time?>" />

<script type="text/javascript" src="/__PUBLIC__/jquery-easyui-1.4.5/jquery.min.js" ></script>
<script type="text/javascript" src="/__PUBLIC__/jquery-easyui-1.4.5/jquery.easyui.min.js" ></script>
<script type="text/javascript" src="/__PUBLIC__/jquery-easyui-1.4.5/locale/easyui-lang-zh_CN.js" ></script>

<script type="text/javascript" src="/__PUBLIC__/jquery-easyui-1.4.5/datagrid-detailview.js"></script>

<script type="text/javascript" src="/__PUBLIC__/syExt/js/syExtJquery.js?t=<?php echo $_time?>" ></script>
<script type="text/javascript" src="/__PUBLIC__/syExt/js/syExtJavascript.js?t=<?php echo $_time?>"></script>
<script type="text/javascript" src="/__PUBLIC__/syExt/js/syExtEasyUI.js?t=<?php echo $_time?>" ></script>
<script type="text/javascript" src="/__PUBLIC__/syExt/js/syExtJqueryAjax.js?t=<?php echo $_time?>" ></script>

