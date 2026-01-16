{assign name="breadcrumbMenu" value=":service('SystemMenu')->getBreadcrumbMenu($currentMenu.menuId)"}
<div class="easy-breadcrumb">
    <div class="layui-breadcrumb">
        {foreach $breadcrumbMenu as $breadcrumb}
        <a href="javascript:void(0);">{$breadcrumb.name}</a>
        {/foreach}
    </div>
    <a href="javascript:void(0);" class="easy-breadcrumb-close easy-close-layer easy-breadcrumb-close-[close]">
        <i class="fa fa-fw fa-close"></i>
    </a>
</div>