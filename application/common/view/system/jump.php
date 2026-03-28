<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title>跳转提示</title>
    <link rel="stylesheet" href="<?php echo static_url('/admin/plugin/layui/css/layui.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo static_url('/admin/css/var.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo static_url('/admin/css/theme.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo static_url('/admin/css/jump.css'); ?>"/>
</head>
<body>

<div class="easy-message {if $code == 1}easy-success{else/}easy-error{/if}">
    {if $code == 1}
    <img class="image" src="<?php echo static_url('/admin/img/success.png'); ?>"/>
    {else/}
    <img class="image" src="<?php echo static_url('/admin/img/error.png'); ?>"/>
    {/if}
    <h1>{$msg}</h1>
    <div class="tips-text">
        <span>页面自动跳转中，等待时间：</span>
        <span class="wait-time">{$wait}</span>秒
    </div>
    <div class="btn-group">
        <button class="layui-btn layui-btn-danger btn-close">关闭页面</button>
        <button class="layui-btn btn-jump">立即跳转</button>
    </div>
</div>

<script src="<?php echo static_url('/admin/plugin/layui/layui.js'); ?>"></script>
<script type="text/javascript">
    layui.use('jquery', function () {

        const jQuery = layui.jquery;
        const index = parent.layer.getFrameIndex(window.name);

        let jumpUrl = '{$url}';
        let waitTime = '{$wait}';

        setInterval(() => {
            waitTime--;
            if (waitTime <= 0) {
                if (index) {
                    parent.layer.close(index);
                } else {
                    top.location.href = jumpUrl;
                }
            }
            jQuery(".wait-time").text(waitTime);
        }, 1000);

        jQuery(".btn-jump").click(() => {
            if (index) {
                parent.layer.close(index);
            } else {
                top.location.href = jumpUrl;
            }
        });

        jQuery(".btn-close").click(() => {
            if (index) {
                parent.layer.close(index);
            } else {
                window.history.back();
            }
        });
    });
</script>
</body>
</html>