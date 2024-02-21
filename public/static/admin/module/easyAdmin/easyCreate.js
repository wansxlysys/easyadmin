layui.define(['easyAdmin', 'easyBuilder', 'jquery', 'laydate', 'uploadFile', 'uploadImage'], function (exports) {

    var laydate = layui.laydate;
    var easyAdmin = layui.easyAdmin;
    var uploadImage = layui.uploadImage;
    var easyBuilder = layui.easyBuilder;

    /**
     * 面板分割
     */
    $('.split').each(function () {

        let direction = $(this).data('direction');

        let elem = [];
        let size = [];

        $(this).find('.split-item').each(function () {
            elem.push(this);
            size.push($(this).data('size'));
        });

        $(this).addClass('split-' + direction);

        Split(elem, {
            sizes: size,
            minSize: 200,
            gutterSize: 6,
            direction: direction
        });
    });

    /**
     * 富文本编辑器
     */
    $(".easy-ueditor").each(function () {
        easyBuilder.UEditor({
            elem: this
        });
    });

    /**
     * alert关闭控制
     */
    $(document).on('click', '.easy-alert-close', function () {
        $(this).closest(".easy-alert").remove();
    });

    /**
     * 关闭当前所在弹出层
     */
    $(document).on('click', '.easy-close-layer', function () {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    });

    /**
     * 日期选择器
     */
    $(document).on('click', '.easy-build-date', function () {
        laydate.render({
            elem: this,
            show: true
        });
    });

    /**
     * 时间选择器
     */
    $(document).on('click', '.easy-build-time', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'time',
        });
    });

    /**
     * 日期时间选择器
     */
    $(document).on('click', '.easy-build-datetime', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'datetime',
        });
    });

    /**
     * 图片上传变量后缀
     * @type {string}
     */
    var uploadImageVarSuffix = 'ImageUploader';

    /**
     * 单图上传
     */
    $(".layui-builder-image").each(function (key, item) {
        (function () {
            var name = $(item).attr("name");
            var value = $(item).val();
            var loading = null;
            var uploader = name + uploadImageVarSuffix;

            window[uploader] = uploadImage.render({
                elem: "#" + name,
                name: "file",
                number: 1,
                multiple: true,
                url: apiUrl.uploadImage,
                before: function () {
                    loading = easyAdmin.showLoading();
                },
                done: function (url) {
                    $(item).val(url);
                    top.layer.close(loading);
                },
                ready: function (that) {
                    if (value) {
                        that.append(value);
                    }
                },
                update: function () {
                    $(item).val(window[uploader].getAll().join(','));
                }
            });
        })();
    });

    /**
     * 多图上传
     */
    $(".layui-builder-picture").each(function (key, item) {
        (function () {
            var name = $(item).attr("name");
            var value = $(item).val();
            var loading = null;
            var uploader = name + uploadImageVarSuffix;

            window[uploader] = uploadImage.render({
                elem: "#" + name,
                name: "file",
                number: 10,
                multiple: true,
                url: apiUrl.uploadImage,
                before: function () {
                    loading = easyAdmin.showLoading();
                },
                done: function (url) {
                    $(item).val(window[uploader].getAll().join(','));
                    top.layer.close(loading);
                },
                ready: function (that) {
                    if (value) {
                        value = value.split(',');
                        for (var i = 0; i < value.length; i++) {
                            that.append(value[i]);
                        }
                    }
                },
                update: function () {
                    $(item).val(window[uploader].getAll().join(','));
                }
            });
        })();
    });

    /**
     * 获取上传实例
     */
    function getUploader(name, fn) {

        var uploader = window[name + uploadImageVarSuffix];

        if (typeof fn === 'function') {
            fn(uploader.uploader);
        } else {
            return uploader.uploader;
        }
    }

    /**
     * 导出
     */
    exports("easyCreate", {
        getUploader: getUploader
    });
});