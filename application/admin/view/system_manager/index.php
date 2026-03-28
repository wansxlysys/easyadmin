{extend name="common@layout/layout" /}

{block name="content"}
{include file="common@layout/breadcrumb" /}
<div class="layui-fluid layui-content">
    <div class="layui-card">
        <div class="layui-card-header">{$currentMenu.name}</div>
        <div class="layui-card-body">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">管理员账号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="account" class="layui-input" placeholder="请输入管理员账号">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">管理员状态</label>
                        <div class="layui-input-inline">
                            <select name="status">
                                <option value=""></option>
                                <option value="1">启用</option>
                                <option value="2">禁用</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">管理员角色</label>
                        <div class="layui-input-inline">
                            <div id="role"></div>
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
        <button class="layui-btn layui-btn-sm" lay-event="create">
            <i class="fa fa-fw fa-plus"></i>管理员添加
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

<script type="text/html" id="avatar">
    <img src="{{d.avatar}}" width="35" height="35" class="layui-circle">
</script>

<script type="text/html" id="status">
    {{#  if(d.status == 1){ }}<span class="layui-badge layui-bg-success">启用</span>{{#  } }}
    {{#  if(d.status == 2){ }}<span class="layui-badge layui-bg-danger">禁用</span>{{#  } }}
    {{#  if(d.status == 3){ }}<span class="layui-badge layui-bg-warning">锁定</span>{{#  } }}
</script>
{/block}

{block name="js"}
<script>
    layui.use(['easyModule'], function () {

        const form = layui.form;
        const table = layui.table;
        const easyAdmin = layui.easyAdmin;
        const easyService = layui.easyService;

        let roleSelect = null;

        easyService.roleSingleSelect({
            elem: '#role',
            ready: function (singleSelect) {
                roleSelect = singleSelect;
            }
        }, {
            name: 'roleId'
        });

        table.render({
            id: "table",
            elem: '#table',
            url: "{:url('admin/SystemManager/index')}",
            toolbar: '#toolbar',
            cols: [[
                {type: 'checkbox'},
                {title: '头像', field: 'avatar', width: 80, templet: "#avatar"},
                {title: '管理员账号', field: 'account', width: 240},
                {title: '管理员角色', field: 'roleName', width: 240},
                {title: '管理员姓名', field: 'realName'},
                {title: '管理员状态', field: 'status', width: 110, templet: "#status"},
                {title: '登录时间', field: 'loginTime', width: 160},
                {title: '操作', toolbar: '#bar', width: 170}
            ]]
        });

        table.on('toolbar(table)', function (obj) {
            if (obj.event === 'create') {
                easyAdmin.openFrame({
                    content: "{:url('admin/SystemManager/create')}"
                });
            }
        });

        table.on('tool(table)', function (obj) {
            if (obj.event === 'update') {
                easyAdmin.openFrame({
                    content: "{:url('admin/SystemManager/update')}?managerId=" + obj.data.managerId
                });
            }

            if (obj.event === 'delete') {
                top.layer.confirm('确定删除吗？', {
                    icon: 3,
                }, function () {
                    easyAdmin.ajaxPost({
                        url: "{:url('admin/SystemManager/delete')}",
                        data: {
                            managerId: obj.data.managerId
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
            roleSelect.setValue([]);
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
