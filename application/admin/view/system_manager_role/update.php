{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色名称</label>
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
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色级别</label>
                    <div class="layui-input-block">
                        <input type="text" name="level" placeholder="请输入角色级别" class="layui-input" value="{$role.level}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">角色备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入角色备注" class="layui-textarea">{$role.remark}</textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label layui-required">角色权限</label>
                    <div class="layui-input-block">
                        <div id="permission" class="ztree"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit>提交</button>
                        <button type="button" class="layui-btn layui-btn-danger one-close-layer">关闭</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script>
    layui.use(['oneModule'], function () {

        const form = layui.form;
        const oneAdmin = layui.oneAdmin;
        const oneHelper = layui.oneHelper;
        const oneService = layui.oneService;

        let permissionTree = null;

        oneService.menuTreeStruct({
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

            let permission = oneHelper.objectColumn(permissionTree.getCheckedNodes(), 'menuId');

            if (permission.length <= 0) {
                return layer.alert('请选择授权菜单', {
                    icon: 2
                });
            }

            obj.field.roleId = '{$role.roleId}';
            obj.field.permission = permission.join(',');

            oneAdmin.ajaxPost({
                url: "{:url('admin/SystemManagerRole/update')}",
                data: obj.field,
                success: function (result) {
                    const lay = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        parent.layui.table.reloadData("table");
                        top.layer.close(lay);
                        oneAdmin.closeFrame();
                    });
                }
            });
        });
    });
</script>
{/block}