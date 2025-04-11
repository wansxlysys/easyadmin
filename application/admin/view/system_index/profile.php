{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">头像</label>
                    <div class="layui-input-block">
                        <div id="avatar"></div>
                        <input type="hidden" name="avatar" class="layui-builder-image" lay-verify="required" lay-reqText="请上传头像" value="{$manager.avatar}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">姓名</label>
                    <div class="layui-input-block">
                        <input type="text" name="realName" lay-verify="required" placeholder="请输入姓名" class="layui-input" value="{$manager.realName}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">账号</label>
                    <div class="layui-input-block">
                        <input type="text" name="account" lay-verify="required" placeholder="请输入账号" class="layui-input layui-disabled" disabled value="{$manager.account}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="text" name="password" placeholder="如无需修改请留空" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="">保存</button>
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
        const easyCreate = layui.easyCreate;

        /**
         * 设置上传路径
         */
        easyCreate.getUploader('avatar', function (uploader) {
            uploader.config.url = "{:url('admin/SystemManager/avatar')}";
        });

        form.on('submit', function (obj) {
            event.preventDefault();

            obj.field.id = '{$manager.id}';

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemIndex/profile')}",
                data: obj.field,
                success: function (result) {
                    var lay = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        top.layer.close(lay);
                        easyAdmin.closeFrame();
                    });
                }
            });
        });
    });
</script>
{/block}