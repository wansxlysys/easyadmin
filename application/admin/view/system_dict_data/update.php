{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典标签</label>
                    <div class="layui-input-block">
                        <input type="text" name="label" lay-verify="required" placeholder="请输入字典标签" class="layui-input" value="{$dict.label}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">字典数据</label>
                    <div class="layui-input-block">
                        <input type="text" name="value" lay-verify="required" placeholder="请输入字典数据" class="layui-input" value="{$dict.value}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">字典样式</label>
                    <div class="layui-input-block">
                        <input type="text" name="style" placeholder="请输入字典样式" class="layui-input" value="{$dict.style}">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label layui-required">是否默认</label>
                    <div class="layui-input-block">
                        <input type="radio" name="isDefault" value="Y" title="是" {if $dict.isDefault == 'Y'}checked{/if}>
                        <input type="radio" name="isDefault" value="N" title="否" {if $dict.isDefault == 'N'}checked{/if}>
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

        form.on('submit', function (obj) {
            event.preventDefault();

            obj.field.dataId = "{$dict.dataId}";

            oneAdmin.ajaxPost({
                url: "{:url('admin/SystemDictData/update')}",
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
