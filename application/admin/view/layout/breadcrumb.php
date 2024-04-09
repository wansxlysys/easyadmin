<?php
/** @noinspection PhpUndefinedVariableInspection */
$breadcrumbMenu = service('SystemMenu')->getBreadcrumbMenu($currentMenu['id']);
?>
<div class="easy-breadcrumb">
    <div class="layui-breadcrumb">
        {volist name="$breadcrumbMenu" id="vo"}
        <a href="javascript:void(0);">{$vo.name}</a>
        {/volist}
    </div>
    <a href="javascript:void(0);" class="easy-breadcrumb-close easy-close-layer easy-breadcrumb-close-[close]">
        <i class="fa fa-fw fa-close"></i>
    </a>
</div>