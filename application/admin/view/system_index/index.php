{extend name="common@layout/layout" /}

{block name="content"}
<div class="one-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo layui-bg-black">{$systemSetting.systemName}</div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item" lay-unselect lay-header-event="outdent">
                <a href="javascript:">
                    <i class="fa fa-fw fa-outdent"></i>
                </a>
            </li>
            <li class="layui-nav-item" lay-unselect lay-header-event="refresh">
                <a href="javascript:">
                    <i class="fa fa-fw fa-arrows-rotate"></i>
                </a>
            </li>
        </ul>

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item" lay-unselect lay-header-event="fullscreen">
                <a href="javascript:">
                    <i class="fa fa-fw fa-maximize"></i>
                </a>
            </li>
            <li class="layui-nav-item layui-nav-avatar">
                <a href="javascript:">
                    <img src="{$loginManager.avatar}" class="layui-nav-img layui-circle">
                    {$loginManager.realName}
                </a>
                <dl class="layui-nav-child" style="text-align: center">
                    <dd lay-header-event="profile"><a href="">个人资料</a></dd>
                    <dd lay-header-event="logout"><a href="">退出登录</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item" lay-unselect lay-header-event="system">
                <a href="javascript:">
                    <i class="fa fa-fw fa-circle-info"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree" lay-accordion>
                {foreach $menuTree as $menu1}
                <li class="layui-nav-item {if $menu1.menuId == 75}layui-nav-itemed{/if}">
                    <a href="javascript:" data-link="{$menu1.url}" data-target="{$menu1.target}">
                        <i class="fa fa-fw {$menu1.icon}"></i>
                        <span>{$menu1.name}</span>
                    </a>
                    {notempty name="$menu1.children"}
                    <dl class="layui-nav-child">
                        {foreach $menu1.children as $menu2}
                        <dd class="{if $menu2.menuId == 128}layui-this{/if}">
                            <a href="javascript:" data-link="{$menu2.url}" data-target="{$menu2.target}">
                                <i class="fa fa-fw {$menu2.icon}"></i>
                                <span>{$menu2.name}</span>
                            </a>
                            {notempty name="$menu2.children"}
                            <dl class="layui-nav-child">
                                {foreach $menu2.children as $menu3}
                                <dd>
                                    <a href="javascript:" data-link="{$menu3.url}" data-target="{$menu3.target}">
                                        <i class="fa fa-fw {$menu3.icon}"></i>
                                        <span>{$menu3.name}</span>
                                    </a>
                                </dd>
                                {/foreach}
                            </dl>
                            {/notempty}
                        </dd>
                        {/foreach}
                    </dl>
                    {/notempty}
                </li>
                {/foreach}
            </ul>
        </div>
    </div>
    <div class="layui-body">
        <iframe id="oneLayoutIframe" class="one-layout-iframe" src="{:url('admin/SystemIndex/console')}"></iframe>
    </div>
</div>
{/block}

{block name="js"}
<script>
    layui.use(['oneModule'], function () {

        const util = layui.util;
        const layer = layui.layer;
        const oneAdmin = layui.oneAdmin;

        jQuery('.layui-nav-tree>.layui-nav-item a').on('click', function (event) {
            event.preventDefault();

            if (jQuery(this).siblings('.layui-nav-child').length <= 0) {
                const link = jQuery(this).data("link");
                const target = jQuery(this).data('target');

                if (target === 1) {
                    jQuery("#oneLayoutIframe").attr("src", link);
                } else if (target === 2) {
                    location.href = link;
                } else if (target === 3) {
                    window.open(link);
                }
            }
        });

        util.event('lay-header-event', {
            outdent() {
                jQuery(".one-layout").toggleClass("one-layout-hide-side");
            },
            system() {
                layer.open({
                    type: 2,
                    title: '系统信息',
                    content: "{:url('admin/SystemIndex/system')}",
                    area: ['260px', '100%'],
                    offset: 'rt',
                    shadeClose: true,
                    move: false,
                });
            },
            refresh() {
                let $iframe = jQuery("#oneLayoutIframe");
                $iframe.attr("src", $iframe.attr("src"));
            },
            fullscreen() {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else {
                    document.documentElement.requestFullscreen();
                }
            },
            profile() {
                event.preventDefault();
                frames[0].layui.oneAdmin.openFrame({
                    content: "{:url('admin/SystemIndex/profile')}"
                });
            },
            logout() {
                event.preventDefault();
                oneAdmin.ajaxPost({
                    url: "{:url('admin/SystemIndex/logout')}",
                    success: function (result) {
                        top.layer.alert(result.msg, {
                            icon: 1
                        }, function () {
                            location.href = "{:url('admin/SystemLogin/login')}";
                        });
                    }
                });
            }
        });
    });
</script>

{/block}