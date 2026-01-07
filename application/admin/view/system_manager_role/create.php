{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入角色名" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色标识</label>
                    <div class="layui-input-block">
                        <input type="text" name="identify" lay-verify="required" placeholder="请输入角色标识" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">角色排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" placeholder="请输入角色排序" class="layui-input" value="100">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">角色备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入角色备注" class="layui-textarea"></textarea>
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

        const form = layui.form;
        const easyAdmin = layui.easyAdmin;
        const easyHelper = layui.easyHelper;
        const easyService = layui.easyService;

        let permissionTree = null;

        easyService.menuTreeStruct({
            elem: "#permission",
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

            let permission = easyHelper.objectColumn(permissionTree.getCheckedNodes(), 'id');

            if (permission.length <= 0) {
                return layer.alert('请选择授权菜单', {
                    icon: 2
                });
            }

            obj.field.permission = permission.join(',');

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemManagerRole/create')}",
                data: obj.field,
                success: function (result) {
                    const lay = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        parent.layui.table.reloadData("table");
                        top.layer.close(lay);
                        easyAdmin.closeFrame();
                    });
                }
            });
        });
    });
</script>
{/block}
