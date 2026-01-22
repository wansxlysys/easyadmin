{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">头像</label>
                    <div class="layui-input-block">
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
                        <input type="password" name="password" placeholder="如无需修改请留空" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit>保存</button>
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

        form.on('submit', function (obj) {
            event.preventDefault();

            obj.field.managerId = '{$manager.managerId}';

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemIndex/profile')}",
                data: obj.field,
                success: function (result) {
                    const lay = top.layer.alert(result.msg, {
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