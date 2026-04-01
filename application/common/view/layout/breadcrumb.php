{assign name="breadcrumbMenu" value=":service('SystemMenu')->getBreadcrumbMenu($currentMenu.menuId)"}
<div class="one-breadcrumb">
    <div class="layui-breadcrumb">
        {foreach $breadcrumbMenu as $breadcrumb}
        <a href="javascript:void(0);">{$breadcrumb.name}</a>
        {/foreach}
    </div>
    <a href="javascript:void(0);" class="one-breadcrumb-close one-close-layer one-breadcrumb-close-[close]">
        <i class="fa fa-fw fa-close"></i>
    </a>
</div>