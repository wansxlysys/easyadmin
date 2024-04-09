{extend name="admin@layout/layout" /}

{block name="content"}
{include file="admin@layout/breadcrumb" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">角色名称</label>
                        <div class="layui-input-inline">
                            <input type="text" name="name" class="layui-input" placeholder="请输入角色名称">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="reset" class="layui-btn layui-btn-danger" lay-submit="" lay-filter="reset">
                            <i class="fa fa-fw fa-refresh"></i>重置
                        </button>
                        <button type="submit" class="layui-btn" lay-submit="" lay-filter="search">
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
            <i class="fa fa-fw fa-plus"></i>角色添加
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
            url: "{:url('admin/ManagerRole/index')}",
            toolbar: '#toolbar',
            cols: [[
                {type: 'checkbox'},
                {title: 'ID', field: 'id', width: 80},
                {title: '角色名称', field: 'name', width: 240},
                {title: '角色标识', field: 'identify', width: 240},
                {title: '角色备注', field: 'remark'},
                {title: '操作', toolbar: '#bar', width: 180}
            ]]
        });

        table.on('toolbar(table)', function (obj) {
            if (obj.event === 'create') {
                easyAdmin.openFrame({
                    content: "{:url('admin/ManagerRole/create')}"
                });
            }
        });

        table.on('tool(table)', function (obj) {

            if (obj.event === "update") {
                easyAdmin.openFrame({
                    content: "{:url('admin/ManagerRole/update')}?id=" + obj.data.id
                });
            }

            if (obj.event === "delete") {
                top.layer.confirm('确定删除吗？', {
                    icon: 3,
                }, function () {
                    easyAdmin.ajaxPost({
                        url: "{:url('admin/ManagerRole/delete')}",
                        data: {
                            id: obj.data.id
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
