{extend name="common@layout/layout" /}

{block name="css"}
<style>
    html,
    body {
        width: 100%;
        height: 100%;
        background-color: #fff;
    }
</style>
{/block}

{block name="content"}
<div class="layui-fluid layui-content">

    <div class="layui-hide">
        <input type="file" multiple id="selectBtn"/>
    </div>

    <script type="text/html" id="toolbar">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" lay-event="upload">
                <i class="fa fa-fw fa-upload"></i>开始上传
            </button>
            <button class="layui-btn layui-btn-sm layui-bg-blue" lay-event="select">
                <i class="fa fa-fw fa-plus"></i>文件选择
            </button>
            <button class="layui-btn layui-btn-sm layui-bg-red" lay-event="clear">
                <i class="fa fa-fw fa-close"></i>清空列表
            </button>
        </div>
    </script>

    <script type="text/html" id="bar">
        <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete">
            <i class="fa fa-fw fa-trash"></i>移除
        </button>
    </script>

    <script type="text/html" id="progress">
        {{d.progress}}%
    </script>

    <script type="text/html" id="status">
        {{#  if(d.status == 'ready'){ }}<span class="layui-badge layui-bg-blue">等待上传</span>{{#  } }}
        {{#  if(d.status == 'hashing'){ }}<span class="layui-badge layui-bg-red">正在校验</span>{{#  } }}
        {{#  if(d.status == 'checking'){ }}<span class="layui-badge layui-bg-red">准备上传</span>{{#  } }}
        {{#  if(d.status == 'uploading'){ }}<span class="layui-badge layui-bg-green">正在上传</span>{{#  } }}
        {{#  if(d.status == 'success'){ }}<span class="layui-badge layui-bg-green">上传成功</span>{{#  } }}
        {{#  if(d.status == 'error'){ }}<span class="layui-badge layui-bg-red">上传失败</span>{{#  } }}
    </script>

    <table class="layui-hide" id="table" lay-filter="table"></table>
</div>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule'], function () {

        const table = layui.table;
        const easyAdmin = layui.easyAdmin;
        const easyHelper = layui.easyHelper;

        const uploader = new Uploader({
            concurrentFiles: 3,
            requestHandlers: {
                checkFile(data) {
                    return new Promise((resolve, reject) => {
                        easyAdmin.ajaxGet({
                            url: "{:url('admin/SystemUpload/check')}",
                            data: data,
                            loading: false,
                            success: function (result) {
                                resolve(result.data)
                            },
                            error: function (error) {
                                reject(error);
                            }
                        });
                    })
                },
                uploadFile(data) {
                    return new Promise((resolve, reject) => {
                        easyAdmin.ajaxPost({
                            url: "{:url('admin/SystemUpload/upload')}",
                            data: data,
                            loading: false,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                resolve(result.data)
                            },
                            error: function (error) {
                                reject(error);
                            }
                        });
                    })
                }
            }
        });

        uploader.on('fileAdded', function (fileObj) {
            fileObj.fileUnit = easyHelper.formatFileSize(fileObj.fileSize)
            fileList.push(fileObj)
            table.reloadData("table")
        });

        uploader.on('progress', function () {
            table.reloadData("table")
        });

        uploader.on('hashCalculated', function () {
            table.reloadData("table")
        });

        uploader.on('uploadStart', function () {
            table.reloadData("table")
        });

        uploader.on('uploadSuccess', function () {
            table.reloadData("table")
        });

        uploader.on('uploadError', function (file, error) {
            console.error(file, error)
        });

        uploader.on('allCompleted', function () {
            console.log(111111111111)
        });

        const selectBtn = $('#selectBtn');

        selectBtn.on('change', function () {
            for (const file of this.files) {
                uploader.addFile(file);
            }
            this.value = null;
        });

        const fileList = []

        table.render({
            id: "table",
            elem: '#table',
            toolbar: '#toolbar',
            data: fileList,
            maxHeight: 450,
            cols: [[
                {title: '文件名称', field: 'fileName'},
                {title: '文件大小', field: 'fileUnit', width: 120},
                {title: '上传进度', width: 100, templet: '#progress'},
                {title: '上传状态', width: 100, templet: "#status"},
                {title: '操作', toolbar: '#bar', width: 100}
            ]],
            page: false,
            limit: Infinity
        });

        table.on('toolbar(table)', function (obj) {

            if (obj.event === 'upload') {
                uploader.startUpload()
            }

            if (obj.event === 'clear') {
                fileList.length = 0
                uploader.clearFile()
                table.reloadData("table")
            }

            if (obj.event === 'select') {
                selectBtn.trigger('click')
            }
        });

        table.on('tool(table)', function (obj) {
            const fileObj = obj.data;

            if (obj.event === 'delete') {
                const index = fileList.findIndex((fileData) => fileData.fileId === fileObj.fileId)

                if (index !== -1) {
                    fileList.splice(index, 1)
                    uploader.removeFile(fileObj)
                }

                table.reloadData("table")
            }
        });

    });
</script>
{/block}