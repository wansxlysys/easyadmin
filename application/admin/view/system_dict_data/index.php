{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" close="show"/}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">字典名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" class="layui-input" placeholder="请输入字典名称">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">字典标识</label>
                        <div class="layui-input-inline">
                            <input type="text" name="identify" class="layui-input" placeholder="请输入字典标识">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="reset" class="layui-btn layui-btn-danger" lay-filter="reset" lay-submit>
                            <i class="fa fa-fw fa-refresh"></i>重置
                        </button>
                        <button type="submit" class="layui-btn" lay-filter="search" lay-submit>
                            <i class="fa fa-fw fa-search"></i>搜索
                        </button>
                    </div>
                </div>
            </form>
            <table class="layui-hide" id="table" lay-filter="table"></table>
        </div>
    </div>
</div>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm layui-btn-default" lay-event="create">
            <i class="fa fa-fw fa-plus"></i>字典添加
        </button>
    </div>
</script>

<script type="text/html" id="bar">
    <button class="layui-btn layui-btn-sm" lay-event="update">
        <i class="fa fa-fw fa-edit"></i>修改
    </button>
    <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete">
        <i class="fa fa-fw fa-trash"></i>删除
    </button>
</script>

<script type="text/html" id="status">
    {{#  if(d.status == 'Y'){ }}<span class="layui-badge layui-bg-green">启用</span>{{#  } }}
    {{#  if(d.status == 'N'){ }}<span class="layui-badge">禁用</span>{{#  } }}
</script>

<script type="text/html" id="isDefault">
    {{#  if(d.isDefault == 'Y'){ }}<span class="layui-badge layui-bg-green">是</span>{{#  } }}
    {{#  if(d.isDefault == 'N'){ }}<span class="layui-badge">否</span>{{#  } }}
</script>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule', 'form', 'table'], function () {

        const form = layui.form;
        const table = layui.table;
        const easyAdmin = layui.easyAdmin;

        table.render({
            id: "table",
            elem: '#table',
            url: "{:url('admin/SystemDictData/index')}?dictId={$request->get('dictId')}",
            toolbar: '#toolbar',
            cols: [[
                {type: 'checkbox'},
                {title: '字典名称', field: 'label', width: 240},
                {title: '字典数据', field: 'value', width: 240},
                {title: '字典样式', field: 'style', width: 240},
                {title: '字典备注', field: 'remark'},
                {title: '是否默认', field: 'isDefault', width: 100, templet: "#isDefault"},
                {title: '字典状态', field: 'status', width: 100, templet: "#status"},
                {title: '字典排序', field: 'sort', width: 100},
                {title: '操作', toolbar: '#bar', width: 180}
            ]]
        });

        table.on('toolbar(table)', function (obj) {
            if (obj.event === 'create') {
                easyAdmin.openFrame({
                    content: "{:url('admin/SystemDictData/create')}?dictId={$request->get('dictId')}"
                });
            }
        });

        table.on('tool(table)', function (obj) {

            if (obj.event === "update") {
                easyAdmin.openFrame({
                    content: "{:url('admin/SystemDictData/update')}?dataId=" + obj.data.dataId
                });
            }

            if (obj.event === "delete") {
                top.layer.confirm('确定删除吗？', {
                    icon: 3,
                }, function () {
                    easyAdmin.ajaxPost({
                        url: "{:url('admin/SystemDictData/delete')}",
                        data: {
                            dataId: obj.data.dataId
                        },
                        success: function (result) {
                            const lay = top.layer.alert(result.msg, {
                                icon: 1,
                            }, function () {
                                table.reloadData("table");
                                top.layer.close(lay);
                            });
                        }
                    });
                });
            }
        });

        form.on("submit(search)", function (obj) {
            event.preventDefault();
            table.reloadData("table", {
                where: obj.field,
                page: {
                    curr: 1
                },
            });
        });

        form.on("submit(reset)", function (obj) {
            table.reloadData("table", {
                where: {},
                page: {
                    curr: 1
                },
            });
        });
    });
</script>
{/block}
