{extend name="admin@layout/layout" /}

{block name="css"}
<link rel="stylesheet" href="{:register_static('/admin/css/layout.css')}">
{/block}

{block name="content"}
<div class="easy-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo layui-bg-black">{$systemSetting.name}</div>
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item" lay-unselect lay-header-event="outdent">
                <a href="javascript:;">
                    <i class="fa fa-fw fa-outdent"></i>
                </a>
            </li>
            <li class="layui-nav-item" lay-unselect lay-header-event="refresh">
                <a href="javascript:;">
                    <i class="fa fa-fw fa-arrows-rotate"></i>
                </a>
            </li>
        </ul>

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item" lay-unselect lay-header-event="fullscreen">
                <a href="javascript:;">
                    <i class="fa fa-fw fa-maximize"></i>
                </a>
            </li>
            <li class="layui-nav-item layui-nav-avatar">
                <a href="javascript:;">
                    <img src="{$manager.avatar}" class="layui-nav-img">
                    {$manager.realName}
                </a>
                <dl class="layui-nav-child" style="text-align: center">
                    <dd lay-header-event="profile"><a href="">个人资料</a></dd>
                    <dd lay-header-event="logout"><a href="">退出登录</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item" lay-unselect lay-header-event="system">
                <a href="javascript:;">
                    <i class="fa fa-fw fa-circle-info"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree" lay-accordion>
                {volist name="menu" id="menu1"}
                <li class="layui-nav-item {eq name='$menu1.id' value='75'}layui-nav-itemed{/eq}">
                    <a href="javascript:;" data-link="{$menu1.url}" data-target="{$menu1.target}">
                        <i class="fa fa-fw {$menu1.icon}"></i>
                        <span>{$menu1.name}</span>
                    </a>
                    {notempty name="$menu1.children"}
                    <dl class="layui-nav-child">
                        {volist name="$menu1.children" id="menu2"}
                        <dd {eq name="$menu2.id" value="128"} class="layui-this" {/eq}>
                            <a href="javascript:;" data-link="{$menu2.url}" data-target="{$menu2.target}">
                                <i class="fa fa-fw {$menu2.icon}"></i>
                                <span>{$menu2.name}</span>
                            </a>
                            {notempty name="$menu2.children"}
                            <dl class="layui-nav-child">
                                {volist name="$menu2.children" id="menu3"}
                                <dd>
                                    <a href="javascript:;" data-link="{$menu3.url}" data-target="{$menu3.target}">
                                        <i class="fa fa-fw {$menu3.icon}"></i>
                                        <span>{$menu3.name}</span>
                                    </a>
                                </dd>
                                {/volist}
                            </dl>
                            {/notempty}
                        </dd>
                        {/volist}
                    </dl>
                    {/notempty}
                </li>
                {/volist}
            </ul>
        </div>
    </div>
    <div class="layui-body">
        <iframe id="easyLayoutIframe" class="easy-layout-iframe" src="{:url('admin/Home/console')}"></iframe>
    </div>
    <div class="layui-footer">
        SPEEDADMIN版权所有
    </div>
</div>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule', 'element', 'layer', 'util'], function () {

        const util = layui.util;
        const layer = layui.layer;
        const easyAdmin = layui.easyAdmin;

        $('.layui-nav-tree>.layui-nav-item a').click(function (event) {
            event.preventDefault();

            if ($(this).siblings('.layui-nav-child').length <= 0) {
                const link = $(this).data("link");
                const target = $(this).data('target');

                if (target === 1) {
                    $("#easyLayoutIframe").attr("src", link);
                } else if (target === 2) {
                    location.href = link;
                } else if (target === 3) {
                    window.open(link);
                }
            }
        });

        util.event('lay-header-event', {
            outdent() {
                $(".easy-layout").toggleClass("easy-layout-hide-side");
            },
            system() {
                layer.open({
                    type: 2,
                    title: '系统信息',
                    content: "{:url('admin/Index/system')}",
                    area: ['260px', '100%'],
                    offset: 'rt',
                    shadeClose: true,
                    move: false,
                });
            },
            refresh() {
                let $iframe = $("#easyLayoutIframe");
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
                frames[0].layui.easyAdmin.openFrame({
                    content: "{:url('admin/Index/profile')}"
                });
            },
            logout() {
                event.preventDefault();
                easyAdmin.ajaxPost({
                    url: "{:url('admin/Index/logout')}",
                    success: function (result) {
                        top.layer.alert(result.msg, {
                            icon: 1
                        }, function () {
                            location.href = "{:url('admin/Login/login')}";
                        });
                    }
                });
            }
        });
    });
</script>

{/block}