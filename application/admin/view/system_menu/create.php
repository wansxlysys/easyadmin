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
                        <input type="text" name="name" placeholder="请输入菜单名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单图标</label>
                    <div class="layui-input-block">
                        <input type="text" name="icon" lay-verify="required" placeholder="请输入菜单图标" class="layui-input" value="fa-link">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单模块</label>
                    <div class="layui-input-block">
                        <input type="text" name="module" placeholder="请输入菜单模块" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单控制器</label>
                    <div class="layui-input-block">
                        <input type="text" name="controller" placeholder="请输入菜单控制器" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单操作</label>
                    <div class="layui-input-block">
                        <input type="text" name="action" placeholder="请输入菜单操作" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单参数</label>
                    <div class="layui-input-block">
                        <input type="text" name="params" placeholder="请输入菜单参数" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">日志记录</label>
                    <div class="layui-input-block">
                        <input type="radio" name="record" value="Y" title="开启" checked>
                        <input type="radio" name="record" value="N" title="关闭">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="type" value="1" title="菜单" lay-filter="type" checked>
                        <input type="radio" name="type" value="2" title="按钮" lay-filter="type">
                        <input type="radio" name="type" value="3" title="外链" lay-filter="type">
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <label class="layui-form-label layui-required">外链地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="link" placeholder="请输入外链地址" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">跳转方式</label>
                    <div class="layui-input-block">
                        <input type="radio" name="target" value="1" title="默认" lay-filter="target" checked>
                        <input type="radio" name="target" value="2" title="当前" lay-filter="target">
                        <input type="radio" name="target" value="3" title="新开" lay-filter="target">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" placeholder="请输入菜单排序" class="layui-input" value="100">
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

        menuService.initService();

        form.on("submit", function (obj) {
            event.preventDefault();

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemMenu/create')}",
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
