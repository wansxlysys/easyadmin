{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员角色</label>
                    <div class="layui-input-block">
                        <div id="role"></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员头像</label>
                    <div class="layui-input-block">
                        <div id="avatar"></div>
                        <input type="hidden" name="avatar" class="layui-builder-image" lay-verify="required" lay-reqText="请上传管理员头像">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员姓名</label>
                    <div class="layui-input-block">
                        <input type="text" name="realName" lay-verify="required" placeholder="请输入管理员姓名" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员账号</label>
                    <div class="layui-input-block">
                        <input type="text" name="account" lay-verify="required" placeholder="请输入管理员账号" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员密码</label>
                    <div class="layui-input-block">
                        <input type="text" name="password" lay-verify="required" placeholder="请输入管理员密码" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">管理员状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="1" title="启用" checked="">
                        <input type="radio" name="status" value="2" title="禁用">
                        <input type="radio" name="status" value="3" title="锁定">
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
        const easyCreate = layui.easyCreate;
        const easyService = layui.easyService;

        /**
         * 设置上传路径
         */
        easyCreate.getUploader('avatar', function (uploader) {
            uploader.config.url = "{:url('admin/SystemManager/avatar')}";
        });

        easyService.roleSingleSelect({
            elem: '#role'
        }, {
            name: 'roleId',
            layVerify: 'required'
        });

        form.on('submit', function (obj) {
            event.preventDefault();

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemManager/create')}",
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