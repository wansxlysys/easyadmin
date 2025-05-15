{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">设置分类</label>
                    <div class="layui-input-block">
                        <input type="text" name="type" lay-verify="required" placeholder="请输入设置分类" class="layui-input" value="{$setting.type}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">设置名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入设置名称" class="layui-input" value="{$setting.name}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">设置标识</label>
                    <div class="layui-input-block">
                        <input type="text" name="identify" lay-verify="required" placeholder="请输入设置标识" class="layui-input" value="{$setting.identify}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">设置键值</label>
                    <div class="layui-input-block">
                        <input type="text" name="value" lay-verify="required" placeholder="请输入设置键值" class="layui-input" value="{$setting.value}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">设置备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入设置备注" class="layui-textarea">{$setting.remark}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">菜单排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" placeholder="请输入菜单排序" class="layui-input"  value="{$setting.sort}">
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

        form.on('submit', function (obj) {
            event.preventDefault();

            obj.field.settingId = '{$setting.settingId}';

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemSetting/update')}",
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
