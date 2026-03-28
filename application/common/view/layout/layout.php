<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{$systemSetting.systemName} - {$systemSetting.systemSlogan}</title>
    <link rel="stylesheet" href="{:static_url('/admin/plugin/layui/css/layui.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/plugin/fontawesome/css/all.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/plugin/ztree/css/ztree.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/module/layCascader/layCascader.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/css/common.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/css/theme.css')}">
    <link rel="stylesheet" href="{:static_url('/admin/css/application.css')}">
    {block name="css"}{/block}
</head>

<body>
{block name="content"}{/block}
<script src="{:static_url('/admin/plugin/layui/layui.js')}"></script>
<script src="{:static_url('/admin/js/config.js')}"></script>

<!--全局变量-->
{include file="common@layout/var" /}

<script src="{:static_url('/admin/plugin/ueditor/ueditor.config.js')}"></script>
<script src="{:static_url('/admin/plugin/ueditor/ueditor.all.js')}"></script>
<script src="{:static_url('/admin/plugin/moment/moment.min.js')}"></script>
<script src="{:static_url('/admin/plugin/moment/locale/zh-cn.js')}"></script>
<script src="{:static_url('/admin/plugin/split/split.min.js')}"></script>
<script src="{:static_url('/admin/plugin/clipboard/clipboard.min.js')}"></script>
<script src="{:static_url('/admin/plugin/ztree/js/jquery.ztree.all.min.js')}"></script>
<script src="{:static_url('/admin/plugin/spark-md5/spark-md5.min.js')}"></script>
<script src="{:static_url('/admin/plugin/uploader/uploader.js')}"></script>

<!--初始化JS-->
<script>
    moment.locale("zh-cn");
</script>

{block name="js"}{/block}
</body>
</html>
