{extend name="admin@layout/layout" /}

{block name="content"}
{include file="admin@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色名</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入角色名" class="layui-input" value="{$role.name}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色标识</label>
                    <div class="layui-input-block">
                        <input type="text" name="identify" lay-verify="required" placeholder="请输入角色标识" class="layui-input" value="{$role.identify}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入备注" class="layui-textarea">{$role.remark}</textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label layui-required">权限</label>
                    <div class="layui-input-block">
                        <div id="permission" class="ztree"></div>
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

    layui.use(['easyModule'], function () {

        var form = layui.form;
        var easyAdmin = layui.easyAdmin;
        var easyHelper = layui.easyHelper;
        var easyService = layui.easyService;

        var permissionTree = null;

        easyService.menuTreeStruct({
            elem: "#permission",
            checked: "{$role.permission}",
            ready: function (tree) {
                permissionTree = tree;
            }
        }, {
            check: {
                enable: true
            }
        });

        form.on('submit', function (obj) {
            event.preventDefault();

            var permission = easyHelper.objectColumn(permissionTree.getCheckedNodes(), 'id');

            if (permission.length <= 0) {
                return layer.alert('请选择授权菜单', {
                    icon: 2
                });
            }

            obj.field.id = '{$role.id}';
            obj.field.permission = permission.join(',');

            easyAdmin.ajaxPost({
                url: "{:url('admin/ManagerRole/update')}",
                data: obj.field,
                success: function (result) {
                    var key = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        parent.layui.table.reloadData("table");
                        top.layer.close(key);
                        easyAdmin.closeFrame();
                    });
                }
            });
        });
    });
</script>
{/block}