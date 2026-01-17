{extend name="common@layout/layout" /}

{block name="content"}
{include file="admin@system_menu/public" /}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">上级菜单</label>
                    <div class="layui-input-block">
                        <div id="menu"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" placeholder="请输入菜单名称" class="layui-input" value="{$menu.name}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="type" value="1" title="菜单" lay-filter="type" {if $menu.type == 1}checked{/if}>
                        <input type="radio" name="type" value="2" title="按钮" lay-filter="type" {if $menu.type == 2}checked{/if}>
                        <input type="radio" name="type" value="3" title="外链" lay-filter="type" {if $menu.type == 3}checked{/if}>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单图标</label>
                    <div class="layui-input-block">
                        <input type="text" name="icon" lay-verify="required" placeholder="请输入菜单图标" class="layui-input" value="{$menu.icon}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单URL</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" placeholder="请输入菜单URL" class="layui-input" value="{$menu.url}">
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <label class="layui-form-label">外链地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="link" placeholder="请输入外链地址" class="layui-input" value="{$menu.link}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">权限标识</label>
                    <div class="layui-input-block">
                        <input type="text" name="identify" placeholder="请输入权限标识" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日志记录</label>
                    <div class="layui-input-block">
                        <input type="radio" name="record" value="Y" title="开启" {if $menu.record == 'Y'}checked{/if}>
                        <input type="radio" name="record" value="N" title="关闭" {if $menu.record == 'N'}checked{/if}>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">跳转方式</label>
                    <div class="layui-input-block">
                        <input type="radio" name="target" value="1" title="默认" lay-filter="target" {if $menu.target == 1}checked{/if}>
                        <input type="radio" name="target" value="2" title="当前" lay-filter="target" {if $menu.target == 2}checked{/if}>
                        <input type="radio" name="target" value="3" title="新开" lay-filter="target" {if $menu.target == 3}checked{/if}>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" placeholder="请输入菜单排序" class="layui-input" value="{$menu.sort}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit>提交</button>
                        <button type="button" class="layui-btn layui-btn-danger easy-close-layer">关闭</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule'], function () {

        const form = layui.form;
        const easyAdmin = layui.easyAdmin;

        menuData.type = '{$menu.type}';
        menuData.parentId = '{$menu.parentId}';

        menuService.initService();

        form.on("submit", function (obj) {
            event.preventDefault();

            obj.field.menuId = '{$menu.menuId}';

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemMenu/update')}",
                data: obj.field,
                success: function (result) {
                    const lay = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        parent.layui.treeTable.reloadData('table');
                        top.layer.close(lay);
                        easyAdmin.closeFrame();
                    });
                }
            });
        });
    });
</script>
{/block}
