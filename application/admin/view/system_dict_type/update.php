{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入字典名称" class="layui-input" value="{$dict.name}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典标识</label>
                    <div class="layui-input-block">
                        <input type="text" name="identify" lay-verify="required" placeholder="请输入字典标识" class="layui-input" value="{$dict.identify}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">字典备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入字典备注" class="layui-textarea">{$dict.remark|raw}</textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典排序</label>
                    <div class="layui-input-block">
                        <input type="text" name="sort" placeholder="请输入字典排序" class="layui-input" value="{$dict.sort}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="Y" title="启用" {if $dict.status == 'Y'}checked{/if}>
                        <input type="radio" name="status" value="N" title="禁用" {if $dict.status == 'N'}checked{/if}>
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

        form.on('submit', function (obj) {
            event.preventDefault();

            obj.field.dictId = '{$dict.dictId}';

            easyAdmin.ajaxPost({
                url: "{:url('admin/SystemDictType/update')}",
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
