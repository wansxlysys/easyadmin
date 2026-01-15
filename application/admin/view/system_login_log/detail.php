{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <div class="easy-info">
                {service:invoke class="SystemManager" method="getByManagerId" params="$log.managerId" value="manager" /}
                <div class="easy-info-grid easy-info-grid-100 easy-info-grid-center">
                    <div class="easy-info-grid-left">管理员头像：</div>
                    <div class="easy-info-grid-right">
                        <img src="{$manager.avatar}" width="35" height="35" class="layui-circle">
                    </div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">管理员姓名：</div>
                    <div class="easy-info-grid-right">{$manager.realName}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">管理员账号：</div>
                    <div class="easy-info-grid-right">{$manager.account}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">登录IP：</div>
                    <div class="easy-info-grid-right">{$log.loginIp}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">登录时间：</div>
                    <div class="easy-info-grid-right">{$log.createTime}</div>
                </div>
                <div class="easy-info-grid easy-info-grid-25">
                    <div class="easy-info-grid-left">登录状态：</div>
                    <div class="easy-info-grid-right">
                        {eq name="$log.status" value="1"}<span class="layui-badge layui-bg-green">登录成功</span>{/eq}
                        {eq name="$log.status" value="2"}<span class="layui-badge">登录失败</span>{/eq}
                    </div>
                </div>
                <div class="easy-info-grid easy-info-grid-100">
                    <div class="easy-info-grid-left">登录详情：</div>
                    <div class="easy-info-grid-right">{$log.message}</div>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule'], function () {

    });
</script>
{/block}