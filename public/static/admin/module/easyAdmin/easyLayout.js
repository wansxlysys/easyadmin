layui.define(['form', 'table', 'layer', 'laypage', 'easyAdmin', 'easyHelper'], function (exports) {

    const form = layui.form;
    const table = layui.table;
    const layer = layui.layer;
    const laypage = layui.laypage;
    const easyAdmin = layui.easyAdmin;
    const easyHelper = layui.easyHelper;

    const easyLayout = {};

    easyLayout.openFileLayer = function (configs) {

        const template = `
                <div class="layui-fluid layui-content attach">
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
                    <div class="attach-toolbar">
                        <div class="attach-action">
                            <button type="button" class="layui-btn layui-btn-sm confirm-button">
                                <i class="fa fa-fw fa-check"></i>确认
                            </button>
                            <button type="button" class="layui-btn layui-btn-sm layui-btn-danger clear-button">
                                <i class="fa fa-fw fa-close"></i>清空
                            </button>
                            <button type="button" class="layui-btn layui-btn-sm layui-btn-normal upload-button">
                                <i class="fa fa-fw fa-upload"></i>上传
                            </button>
                        </div>
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
            `

        const uploadLayer = layer.open({
            type: 1,
            title: '文件上传',
            area: ['1105px', '805px'],
            content: template,
            success: () => {

                const options = [
                    {'type': 'image', 'value': '图片'},
                    {'type': 'audio', 'value': '音频'},
                    {'type': 'video', 'value': '视频'},
                    {'type': 'doc', 'value': '文档'},
                    {'type': 'zip', 'value': '压缩包'},
                ];

                const setting = {
                    multiple: true,
                    maxNum: Infinity,
                    selectNum: 0,
                    fileType: [],
                    ...configs
                };

                const formData = {
                    name: '',
                    type: setting.fileType,
                    page: 1,
                    limit: 21
                }

                const popupData = {
                    fileList: [],
                    fileTotal: 0,
                    checkedMap: new Map(),
                    isLoading: true,
                    tipsIndex: null,
                }

                const uploadService = {
                    createSelect: function () {
                        options.forEach((option) => {
                            if (setting.fileType.length == 0 || setting.fileType.includes(option.type)) {
                                $('#allowType').append(`<option value="${option.type}">${option.value}</option>`);
                            }
                        });
                        form.render('select');
                    },
                    findFileByEvent(event) {
                        const index = $(event.currentTarget).closest('.attach-grid').index();
                        if (index !== -1) {
                            return popupData.fileList[index];
                        }
                    },
                    listenEvents: function () {

                        const attachList = $('.attach-list');

                        form.on("submit(search)", (obj) => {
                            event.preventDefault();
                            formData.name = obj.field.name;
                            formData.type = obj.field.type;
                            uploadService.loadFileList();
                        });

                        form.on("submit(reset)", () => {
                            formData.name = '';
                            formData.type = setting.fileType;
                            uploadService.loadFileList();
                        });

                        attachList.on('click', '.attach-thumb', (event) => {
                            const file = uploadService.findFileByEvent(event);
                            if (!setting.multiple) {
                                $('.attach-upload').removeClass('attach-checked');
                            }

                            $(event.currentTarget).closest('.attach-upload').toggleClass('attach-checked');

                            if (!setting.multiple) {
                                popupData.checkedMap.clear();
                            }

                            if ($(event.currentTarget).closest('.attach-upload').hasClass('attach-checked')) {
                                popupData.checkedMap.set(file.fileId, file);
                            } else {
                                popupData.checkedMap.delete(file.fileId);
                            }
                        });

                        attachList.on('click', '.attach-rename', (event) => {
                            const file = uploadService.findFileByEvent(event);

                            top.layer.prompt({
                                title: '重命名',
                                placeholder: '请输入文件名',
                                value: file.name
                            }, function (fileName, layKey) {
                                easyAdmin.ajaxPost({
                                    url: apiUrl.renameFile,
                                    data: {
                                        fileName: fileName,
                                        fileId: file.fileId
                                    },
                                    loading: false,
                                    success: function () {
                                        file.name = fileName;
                                        uploadService.renderFile();
                                        top.layer.close(layKey);
                                    }
                                });
                            });
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

                        attachList.on('mouseenter', '.attach-name', (event) => {
                            const file = uploadService.findFileByEvent(event);
                            popupData.tipsIndex = layer.tips(file.name, event.currentTarget);
                        });

                        attachList.on('mouseleave', '.attach-name', () => {
                            if (popupData.tipsIndex) {
                                layer.close(popupData.tipsIndex);
                            }
                        });

                        $('.confirm-button').on('click', () => {

                            const checkedList = Array.from(
                                popupData.checkedMap.values()
                            );

                            if (checkedList.length === 0) {
                                return top.layer.alert('请选择文件', {
                                    icon: 2
                                });
                            }

                            const currentMax = setting.maxNum - setting.selectNum;

                            if (checkedList.length + setting.selectNum > setting.maxNum) {
                                return top.layer.alert(`选择数量不能超过 ${currentMax} 个`, {
                                    icon: 2
                                });
                            }

                            if (setting.selectFile) {
                                setting.selectFile(checkedList)
                            }

                            layer.close(uploadLayer)
                        });

                        $('.clear-button').on('click', () => {
                            popupData.checkedMap.clear();
                            uploadService.renderFile();
                        });

                        $('.upload-button').on('click', () => {
                            const template = `
                                    <div id="upload">
                                        <div class="layui-hide">
                                            <input type="file" multiple class="select-button"/>
                                            <div id="toolbar">
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
                                            </div>
                                            <div id="bar">
                                                <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete">
                                                    <i class="fa fa-fw fa-trash"></i>移除
                                                </button>
                                            </div>
                                            <div id="progress">
                                                {{d.progress}}%
                                            </div>
                                            <div id="status">
                                                {{#  if(d.status == 'ready'){ }}<span class="layui-badge layui-bg-blue">等待上传</span>{{#  } }}
                                                {{#  if(d.status == 'hashing'){ }}<span class="layui-badge layui-bg-orange">正在校验</span>{{#  } }}
                                                {{#  if(d.status == 'checking'){ }}<span class="layui-badge layui-bg-orange">准备上传</span>{{#  } }}
                                                {{#  if(d.status == 'uploading'){ }}<span class="layui-badge layui-bg-green">正在上传</span>{{#  } }}
                                                {{#  if(d.status == 'success'){ }}<span class="layui-badge layui-bg-green">上传成功</span>{{#  } }}
                                                {{#  if(d.status == 'error'){ }}<span class="layui-badge upload-tag-error">上传失败</span>{{#  } }}
                                            </div>
                                        </div>
                                        <div class="layui-fluid layui-content">
                                            <table class="layui-hide" id="table" lay-filter="table"></table>
                                        </div>
                                    </div>
                                `

                            const uploadData = {
                                table: null,
                                fileList: [],
                                uploader: null,
                                tipsIndex: null
                            }

                            layer.open({
                                type: 1,
                                title: '文件管理',
                                area: ['800px', '600px'],
                                content: template,
                                success: function () {

                                    uploadData.uploader = new Uploader({
                                        concurrentFiles: 3,
                                        requestHandlers: {
                                            checkFile(data) {
                                                return new Promise((resolve, reject) => {
                                                    easyAdmin.ajaxGet({
                                                        url: apiUrl.checkFile,
                                                        data: data,
                                                        alert: false,
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
                                                        url: apiUrl.uploadFile,
                                                        data: data,
                                                        alert: false,
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

                                    const reloadRowData = function (file) {
                                        table.updateRow('table', {
                                            related: true,
                                            index: file.LAY_INDEX,
                                            data: {
                                                status: file.status
                                            }
                                        });
                                    }

                                    uploadData.uploader.on('fileAdded', function (fileObj) {
                                        fileObj.fileUnit = easyHelper.formatFileSize(fileObj.fileSize);
                                        uploadData.fileList.push(fileObj);
                                        uploadData.table.reloadData();
                                    });

                                    uploadData.uploader.on('progress', function (file) {
                                        reloadRowData(file);
                                    });

                                    uploadData.uploader.on('hashCalculated', function (file) {
                                        reloadRowData(file);
                                    });

                                    uploadData.uploader.on('uploadStart', function (file) {
                                        reloadRowData(file);
                                    });

                                    uploadData.uploader.on('uploadSuccess', function (file) {
                                        reloadRowData(file);
                                    });

                                    uploadData.uploader.on('uploadError', function (file, error) {
                                        file.errorMsg = error.msg;
                                        reloadRowData(file);
                                    });

                                    uploadData.uploader.on('allCompleted', function () {
                                        uploadService.loadFileList();
                                    });

                                    uploadData.table = table.render({
                                        id: "table",
                                        elem: '#table',
                                        toolbar: '#toolbar',
                                        defaultToolbar: [],
                                        data: uploadData.fileList,
                                        maxHeight: 500,
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
                                            uploadData.uploader.startUpload()
                                        }

                                        if (obj.event === 'clear') {
                                            uploadData.fileList.length = 0
                                            uploadData.uploader.clearFile()
                                            uploadData.table.reloadData()
                                        }

                                        if (obj.event === 'select') {
                                            $('.select-button').trigger('click')
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
                                        }

                                        uploadData.table.reloadData()
                                    });

                                    const upload = $('#upload');
                                    const select = $('.select-button');

                                    select.on('change', function () {
                                        for (const file of this.files) {
                                            uploadData.uploader.addFile(file);
                                        }
                                        this.value = null;
                                    });

                                    upload.on('mouseenter', '.upload-tag-error', function (event) {
                                        const index = $(event.currentTarget).closest('tr').index();
                                        const file = uploadData.fileList[index];
                                        if (file.errorMsg) {
                                            uploadData.tipsIndex = layer.tips(file.errorMsg, event.currentTarget);
                                        }
                                    });

                                    upload.on('mouseleave', '.upload-tag-error', function () {
                                        if (uploadData.tipsIndex) {
                                            layer.close(uploadData.tipsIndex);
                                        }
                                    });
                                },
                                beforeEnd: function () {
                                    if (uploadData.uploader.isUploading()) {
                                        top.layer.msg('请等待上传完成');
                                        return false;
                                    }
                                }
                            });
                        });
                    },
                    loadFileList: function () {
                        popupData.isLoading = true;
                        uploadService.renderLoading();
                        easyAdmin.ajaxGet({
                            url: apiUrl.getListFile,
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
                            $('.attach-load').html(`<div class="attach-loading">
                                                        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop"></i>
                                                        <span>加载中</span>
                                                    </div>`);
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
                                <div class="attach-grid">
                                    <div class="attach-upload ${popupData.checkedMap.has(file.fileId) && 'attach-checked'}">
                                        <div class="attach-check">
                                            <i class="fa fa-fw fa-check"></i>
                                        </div>
                                        <img class="attach-thumb" src="${file.type == 'image' ? file.path : '/static/admin/img/' + file.type + '.png'}">
                                        <div class="attach-tool">
                                            <span class="attach-rename">改名</span>
                                            <span class="attach-look">查看</span>
                                            <span class="attach-addr easy-copy" data-text="${file.path}">复制</span>
                                        </div>
                                    </div>
                                    <div class="attach-name">${file.name}</div>
                                </div>
                            `;
                        }).join(''));
                    }
                };

                uploadService.createSelect();
                uploadService.listenEvents();
                uploadService.loadFileList();
            }
        });
    };

    exports("easyLayout", easyLayout);
});