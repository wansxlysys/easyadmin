layui.define(["jquery", "element"], function (exports) {

    var $ = layui.$;
    var element = layui.element;

    var UploadFile = function (config) {

        var that = this;
        var defaults = {
            id: "",
            url: "",
            check_url: "",
            type: "",
            shard_size: 2,
            max_size: 200,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            error: function (message) {
                that.hideProgress();
                top.layer.alert(message, {
                    icon: 2
                });
            },
            before_send: function () {
                that.setProgress(0);
                that.showProgress();
            },
            progress: function (progress) {
                that.setProgress(progress);
            },
            check_success: function (response) {

                var result = JSON.parse(response);

                if (result.code === 1) {
                    this.complete(result);
                    return false;
                }

                return true;
            },
            success: function (response) {

                var result = JSON.parse(response);

                if (result.code === 0) {
                    that.hideProgress();
                    top.layer.alert(result.msg, {
                        icon: 2
                    });
                    return false;
                }

                if (result.data.isFinish) {
                    this.complete(result);
                }

                return true;
            },
            complete: function (result) {
                that.setValue(result.data.viewPath);
                that.hideProgress();
            }
        };

        this.options = $.extend(true, defaults, config);

        var html = '';

        html += '<div class="upload-file">';
        html += '   <div class="layui-progress" lay-filter="' + this.options.id + '" lay-showPercent="true">';
        html += '       <div class="layui-progress-bar" lay-percent="0%"></div>';
        html += '   </div>';
        html += '</div>';

        this.$elem = $('#' + this.options.id);
        this.$elem.closest(".layui-form-item").append(html);
        this.uploader = new fcup(this.options);

        element.render('progress', this.options.id);
    };

    /**
     * 获取实例
     */
    UploadFile.prototype.getUploader = function () {
        return this.uploader;
    };

    /**
     * 显示上传进度条
     */
    UploadFile.prototype.showProgress = function () {
        this.$elem.closest(".layui-form-item").find(".upload-file").show();
    };

    /**
     * 隐藏上传进度条
     */
    UploadFile.prototype.hideProgress = function () {
        this.$elem.closest(".layui-form-item").find(".upload-file").hide();
    };

    /**
     * 隐藏上传进度条
     */
    UploadFile.prototype.setProgress = function (progress) {
        element.progress(this.options.id, progress + '%');
    };

    /**
     * 隐藏上传进度条
     */
    UploadFile.prototype.setValue = function (viewPath) {
        this.$elem.siblings("input").val(viewPath);
    };

    /**
     * 引入css文件
     */
    layui.link(layui.cache.base + "uploadFile/uploadFile.css");

    /**
     * 导出模块
     */
    exports("uploadFile", UploadFile);
});