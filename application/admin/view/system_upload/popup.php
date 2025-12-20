{extend name="common@layout/layout" /}

{block name="css"}
<style>
    body {
        background-color: #fff;
    }

    .attach {
        padding: 20px;
    }

    .attach-wrap {
        min-height: 465px;
        margin: 15px -7px 5px;
    }

    .attach-list {
        display: flex;
        flex-wrap: wrap;
    }

    .attach-grid {
        width: 140px;
        height: 140px;
        margin: 7px;
        position: relative;
    }

    .attach-upload {
        cursor: pointer;
    }

    .attach-thumb {
        width: 140px;
        height: 140px;
        display: block;
        object-fit: cover;
        border: 1px solid #eee;
        box-sizing: border-box;
    }

    .attach-check {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #fff;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.6);
        visibility: hidden;
        border-radius: 3px;
    }

    .attach-checked .attach-check {
        visibility: visible;
    }

    .attach-name {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 0 5px;
        box-sizing: border-box;
        line-height: 30px;
        text-align: center;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .attach-look {
        position: absolute;
        top: 15px;
        left: 15px;
        color: #fff;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 3px;
        visibility: hidden;
    }

    .attach-grid:hover .attach-look {
        visibility: visible;
    }

    .attach-page {
        text-align: center;
    }

    .attach-page .layui-laypage a,
    .attach-page .layui-laypage span {
        margin: 0 5px;
    }

    .attach-loading,
    .attach-empty {
        flex: 1;
        line-height: 400px;
        color: #999;
        font-size: 16px;
        text-align: center;
    }
</style>
{/block}

{block name="content"}

<div class="upload">
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
</div>

<div class="attach layui-hide">
    <form class="layui-form">
        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">文件名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" class="layui-input" placeholder="请输入文件名称">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">文件类型</label>
                <div class="layui-input-inline">
                    <select id="allowType" name="type">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="layui-inline">
                <button type="reset" class="layui-btn layui-btn-danger" lay-submit lay-filter="reset">
                    <i class="fa fa-fw fa-refresh"></i>重置
                </button>
                <button type="submit" class="layui-btn" lay-submit lay-filter="search">
                    <i class="fa fa-fw fa-search"></i>搜索
                </button>
            </div>
        </div>
    </form>
    <div class="action">
        <button type="button" class="layui-btn layui-btn-sm" id="confirmBtn">
            <i class="fa fa-fw fa-check"></i>选择
        </button>
        <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" id="uploadBtn">
            <i class="fa fa-fw fa-upload"></i>上传
        </button>
    </div>

    <div class="attach-wrap">
        <div class="attach-list"></div>
        <div class="attach-load">
            <div class="attach-loading">加载中</div>
        </div>
    </div>
    <div class="attach-page">
        <div id="attach-page"></div>
    </div>
</div>

<button type="button" class="layui-btn layui-btn-sm">
    <i class="fa fa-fw fa-upload"></i>测试
</button>
{/block}

{block name="js"}
<script>

    layui.use(['easyModule'], function () {

        const form = layui.form;
        const table = layui.table;
        const laypage = layui.laypage;
        const easyAdmin = layui.easyAdmin;
        const easyHelper = layui.easyHelper;

        const options = [
            {'identify': 'image', 'value': '图片'},
            {'identify': 'audio', 'value': '音频'},
            {'identify': 'video', 'value': '视频'},
            {'identify': 'doc', 'value': '文档'},
            {'identify': 'zip', 'value': '压缩包'},
        ];

        const setting = {
            multiple: true,
            selectMax: Infinity,
            selectNum: 0,
            allowType: []
        };

        const formData = {
            name: '',
            type: setting.allowType,
            page: 1,
            limit: 21
        }

        const popupData = {
            fileList: [],
            fileTotal: 0,
            isLoading: true,
            tipsIndex: null,
        }

        const uploadData = {
            fileList: [],
            uploader: null
        }

        const selectBtn = $('#selectBtn');
        const uploadBtn = $('#uploadBtn');
        const confirmBtn = $('#confirmBtn');

        const uploadService = {
            createSelect: function () {
                options.forEach((option) => {
                    if (setting.allowType.includes(option.identify)) {
                        $('#allowType').append(`<option value="${option.identify}">${option.value}</option>`);
                    }
                });
                form.render('select');
            },
            createUploader: function () {
                uploadData.uploader = new Uploader({
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

                uploadData.uploader.on('fileAdded', function (fileObj) {
                    fileObj.fileUnit = easyHelper.formatFileSize(fileObj.fileSize)
                    uploadData.fileList.push(fileObj)
                    table.reloadData("table")
                });

                uploadData.uploader.on('progress', function () {
                    table.reloadData("table")
                });

                uploadData.uploader.on('hashCalculated', function () {
                    table.reloadData("table")
                });

                uploadData.uploader.on('uploadStart', function () {
                    table.reloadData("table")
                });

                uploadData.uploader.on('uploadSuccess', function () {
                    table.reloadData("table")
                });

                uploadData.uploader.on('uploadError', function (file, error) {
                    console.error(file, error)
                });

                uploadData.uploader.on('allCompleted', function () {
                    uploadService.loadFileList();
                });
            },
            listenEvents: function () {

                selectBtn.on('change', function () {
                    for (const file of this.files) {
                        uploadData.uploader.addFile(file);
                    }
                    this.value = null;
                });

                confirmBtn.on('click', () => {

                    const checkedHash = [];
                    const checkedList = [];

                    $('.attach-checked').each((index, element) => {
                        checkedHash.push($(element).closest('.attach-grid').attr('hash'));
                    });

                    if (checkedHash.length == 0) {
                        return top.layer.alert('请选择文件', {
                            icon: 2
                        });
                    }

                    const currentMax = setting.selectMax - setting.selectNum;

                    if (checkedHash.length + setting.selectNum > setting.selectMax) {
                        return top.layer.alert(`选择数量不能超过 ${currentMax} 个`, {
                            icon: 2
                        });
                    }

                    popupData.fileList.forEach((file) => {
                        if (checkedHash.includes(file.hash)) {
                            checkedList.push({
                                name: file.name,
                                path: file.path,
                                size: file.size,
                                type: file.type,
                                hash: file.hash,
                            });
                        }
                    });

                    top.easyEvent.emit('upload:select', checkedList);

                    easyAdmin.closeFrame();
                });

                uploadBtn.on('click', () => {
                    layer.open({
                        type: 1,
                        title: '文件管理',
                        area: ['800px', '600px'],
                        content: `
                        <div class="layui-fluid layui-content">
                            <table class="layui-hide" id="table" lay-filter="table"></table>
                        </div>
                    `,
                        success: function () {
                            table.render({
                                id: "table",
                                elem: '#table',
                                toolbar: '#toolbar',
                                data: uploadData.fileList,
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
                        },
                        beforeEnd: function () {
                            if (uploadData.uploader.uploading) {
                                top.layer.msg('请等待上传完成');
                                return false;
                            } else {
                                uploadData.fileList = []
                                uploadData.uploader.clearFile()
                            }
                        }
                    });
                });

                table.on('toolbar(table)', function (obj) {

                    if (obj.event === 'upload') {
                        uploadData.uploader.startUpload()
                    }

                    if (obj.event === 'clear') {
                        uploadData.fileList = []
                        uploadData.uploader.clearFile()
                        table.reloadData("table")
                    }

                    if (obj.event === 'select') {
                        selectBtn.trigger('click')
                    }
                });

                table.on('tool(table)', function (obj) {
                    const fileObj = obj.data;

                    if (obj.event === 'delete') {
                        const index = uploadData.fileList.findIndex((fileData) => fileData.fileId === fileObj.fileId)

                        if (index !== -1) {
                            uploadData.fileList.splice(index, 1)
                            uploadData.uploader.removeFile(fileObj)
                        }

                        table.reloadData("table")
                    }
                });
            },
            listenSearch: function () {

                form.on("submit(search)", (obj) => {
                    event.preventDefault();
                    formData.name = obj.field.name;
                    formData.type = obj.field.type;
                    uploadService.loadFileList();
                });

                form.on("submit(reset)", () => {
                    formData.name = '';
                    formData.type = setting.allowType;
                    uploadService.loadFileList();
                });

                const attachList = $('.attach-list');

                attachList.on('click', '.attach-thumb', (event) => {
                    if (!setting.multiple) {
                        $('.attach-upload').removeClass('attach-checked');
                    }
                    $(event.currentTarget).closest('.attach-upload').toggleClass('attach-checked');
                });

                attachList.on('click', '.attach-look', (event) => {
                    const index = $(event.currentTarget).closest('.attach-grid').index();
                    const file = popupData.fileList[index];
                    if (file.type == 'image') {
                        const images = popupData.fileList.filter(item => item.type == 'image');
                        top.layer.photos({
                            photos: {
                                start: index,
                                data: images.map(item => ({src: item.path}))
                            }
                        });
                    } else {
                        window.open(file.path);
                    }
                });

                attachList.on('mouseenter', '.attach-grid', (event) => {
                    const index = $(event.currentTarget).index();
                    const file = popupData.fileList[index];
                    popupData.tipsIndex = layer.tips(file.name, event.currentTarget);
                });

                attachList.on('mouseleave', '.attach-grid', () => {
                    if (popupData.tipsIndex) {
                        layer.close(popupData.tipsIndex);
                    }
                });
            },
            loadFileList: function () {
                popupData.isLoading = true;
                uploadService.renderLoading();
                easyAdmin.ajaxGet({
                    url: "{:url('admin/SystemUpload/popup')}",
                    data: formData,
                    loading: false,
                    success: (result) => {
                        popupData.isLoading = false;
                        popupData.fileList = result.data.list;
                        popupData.fileTotal = result.data.total;
                        uploadService.renderPaging();
                        uploadService.renderLoading();
                        uploadService.renderFile();
                    }
                });
            },
            renderLoading: function () {
                if (popupData.isLoading) {
                    $('.attach-list').empty();
                    $('.attach-load').html(`<div class="attach-loading">加载中</div>`);
                } else {
                    if (popupData.fileTotal <= 0) {
                        $('.attach-load').html(`<div class="attach-empty">暂无数据</div>`);
                    } else {
                        $('.attach-load').empty();
                    }
                }
            },
            renderPaging: function () {
                laypage.render({
                    elem: 'attach-page',
                    curr: formData.page,
                    limit: formData.limit,
                    count: popupData.fileTotal,
                    layout: ['count', 'prev', 'page', 'next', 'skip'],
                    jump: (obj, first) => {
                        formData.page = obj.curr;
                        formData.limit = obj.limit;
                        if (!first) {
                            uploadService.loadFileList();
                        }
                    }
                });
            },
            renderFile: function () {
                $('.attach-list').html(popupData.fileList.map(file => {
                    return `
                    <div class="attach-grid" hash="${file.hash}">
                        <div class="attach-upload">
                            <div class="attach-check">
                                <i class="fa fa-fw fa-check"></i>
                            </div>
                            <div class="attach-look">
                                <i class="${file.type == 'image' ? 'fa fa-fw fa-eye' : 'fa fa-fw fa-download'}"></i>
                            </div>
                            <div class="attach-name">${file.name}</div>
                            <img class="attach-thumb" src="${file.type == 'image' ? file.path : '/static/admin/img/' + file.type + '.png'}">
                        </div>
                    </div>
                `;
                }).join(''));
            }
        };

        uploadService.createSelect();
        uploadService.createUploader();
        uploadService.listenSearch();
        uploadService.listenEvents();
        uploadService.loadFileList();
    });
</script>
{/block}