{extend name="admin@layout/layout" /}

{block name="content"}
{include file="admin@layout/breadcrumb" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">系统名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请填写系统名称" class="layui-input" value="{$setting.name}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">系统简介</label>
                    <div class="layui-input-block">
                        <textarea name="slogan" lay-verify="required" placeholder="请填写系统简介" class="layui-textarea">{$setting.slogan}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" lay-submit="">保存</button>
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

        form.on('submit', function (obj) {
            event.preventDefault();

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemSetting/system')}",
                data: obj.field,
                success: function (result) {
                    const lay = top.layer.alert(result.msg, {
                        icon: 1,
                    }, function () {
                        top.layer.close(lay);
                    });
                }
            });
        });
    });
</script>
{/block}