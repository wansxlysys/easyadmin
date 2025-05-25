{extend name="common@layout/layout" /}

{block name="content"}
{include file="admin@system_menu/public" /}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
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
                    <label class="layui-form-label layui-required">菜单图标</label>
                    <div class="layui-input-block">
                        <input type="text" name="icon" lay-verify="required" placeholder="请输入菜单图标" class="layui-input" value="{$menu.icon}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单模块</label>
                    <div class="layui-input-block">
                        <input type="text" name="module" placeholder="请输入菜单模块" class="layui-input" value="{$menu.module}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单控制器</label>
                    <div class="layui-input-block">
                        <input type="text" name="controller" placeholder="请输入菜单控制器" class="layui-input" value="{$menu.controller}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单操作</label>
                    <div class="layui-input-block">
                        <input type="text" name="action" placeholder="请输入菜单操作" class="layui-input" value="{$menu.action}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单参数</label>
                    <div class="layui-input-block">
                        <input type="text" name="params" placeholder="请输入菜单参数" class="layui-input" value="{$menu.params}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="type" value="1" title="菜单" lay-filter="type" {eq name="$menu.type" value="1" }checked{/eq}>
                        <input type="radio" name="type" value="2" title="按钮" lay-filter="type" {eq name="$menu.type" value="2" }checked{/eq}>
                        <input type="radio" name="type" value="3" title="外链" lay-filter="type" {eq name="$menu.type" value="3" }checked{/eq}>
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <label class="layui-form-label">外链地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="link" placeholder="请输入外链地址" class="layui-input" value="{$menu.link}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">跳转方式</label>
                    <div class="layui-input-block">
                        <input type="radio" name="target" value="1" title="默认方式" lay-filter="target" {eq name="$menu.target" value="1" }checked{/eq}>
                        <input type="radio" name="target" value="2" title="当前窗口" lay-filter="target" {eq name="$menu.target" value="2" }checked{/eq}>
                        <input type="radio" name="target" value="3" title="新的窗口" lay-filter="target" {eq name="$menu.target" value="3" }checked{/eq}>
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
                        <button type="submit" class="layui-btn" lay-submit="">提交</button>
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

    layui.use(['easyModule', 'form'], function () {

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
