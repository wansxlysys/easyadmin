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
                        <label class="layui-form-label">管理员姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" name="realName" class="layui-input" placeholder="请输入管理员姓名">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">登录状态</label>
                        <div class="layui-input-inline">
                            <select name="status">
                                <option value=""></option>
                                <option value="1">登录成功</option>
                                <option value="2">登录失败</option>
                            </select>
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
        <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="clear">
            <i class="fa fa-fw fa-trash"></i>清空日志
        </button>
    </div>
</script>

<script type="text/html" id="avatar">
    <img src="{{d.avatar}}" width="35" height="35" class="layui-circle">
</script>

<script type="text/html" id="bar">
    <button class="layui-btn layui-btn-sm" lay-event="detail">
        <i class="fa fa-fw fa-search-plus"></i>详情
    </button>
</script>

<script type="text/html" id="status">
    {{#  if(d.status == 1){ }}<span class="layui-badge layui-bg-success">登录成功</span>{{#  } }}
    {{#  if(d.status == 2){ }}<span class="layui-badge layui-bg-danger">登录失败</span>{{#  } }}
</script>
{/block}

{block name="js"}
<script>
    layui.use(['easyAdmin'], function () {

        const form = layui.form;
        const table = layui.table;
        const easyAdmin = layui.easyAdmin;

        table.render({
            id: "table",
            elem: '#table',
            url: "{:url('admin/SystemLoginLog/index')}",
            toolbar: '#toolbar',
            cols: [[
                {type: 'checkbox'},
                {title: '头像', field: 'avatar', width: 80, templet: "#avatar"},
                {title: '管理员账号', field: 'account', width: 140},
                {title: '管理员姓名', field: 'realName', width: 140},
                {title: '登录详情', field: 'message'},
                {title: '登录IP', field: 'loginIp', width: 140},
                {title: '登录状态', field: 'status', width: 100, templet: "#status"},
                {title: '登录时间', field: 'createTime', width: 160},
                {title: '操作', toolbar: '#bar', width: 100}
            ]]
        });

        table.on('toolbar(table)', function (obj) {
            if (obj.event === 'clear') {
                top.layer.confirm("确认清空日志吗？", {
                    icon: 3
                }, function () {
                    easyAdmin.ajaxPost({
                        url: "{:url('admin/SystemLoginLog/clear')}",
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

        table.on('tool(table)', function (obj) {
            if (obj.event === 'detail') {
                easyAdmin.openFrame({
                    content: "{:url('admin/SystemLoginLog/detail')}?logId=" + obj.data.logId
                });
            }
        });

        form.on("submit(search)", function (obj) {
            event.preventDefault();
            table.reloadData("table", {
                where: obj.field,
                page: {
                    curr: 1
                }
            });
        });

        form.on("submit(reset)", function (obj) {
            table.reloadData("table", {
                where: {},
                page: {
                    curr: 1
                }
            });
        });
    });
</script>
{/block}