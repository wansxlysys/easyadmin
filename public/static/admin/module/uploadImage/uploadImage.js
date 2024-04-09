layui.define(["jquery", "upload"], function (exports) {

    var $ = layui.jquery;
    var upload = layui.upload;

    var defaults = {
        elem: "#image",
        url: [],
        name: "image",
        size: 0,
        number: 1,
        filename: "image",
        multiple: false,
        accept: "image/*",
        append: {},
        before: function () {

        },
        done: function () {

        },
        allDone: function () {

        },
        error: function () {

        },
        ready: function () {

        },
        update: function () {

        }
    };

    var UploadImage = function (options) {

        this.uploader = null;
        this.options = $.extend({}, defaults, options);
        this.$elem = $(this.options.elem);
        this.viewer = new Viewer(this.$elem.get(0));

        this.create();
        this.event();
        this.init();

        // 初始化函数
        typeof this.options.ready === "function" && this.options.ready(this);
    };

    /**
     * 初始化事件绑定
     */
    UploadImage.prototype.event = function () {

        var that = this;

        // 向前移动一位
        this.$elem.on("click", ".easy-upload-image-item-icon-left", function () {
            var item = $(this).closest(".easy-upload-image-item");
            if (item.prevAll().length >= 1) {
                item.prev().before(item);
                that.options.update();
            }
        });

        // 向后移动一位
        this.$elem.on("click", ".easy-upload-image-item-icon-right", function () {
            var item = $(this).closest(".easy-upload-image-item");
            if (item.nextAll().length >= 1) {
                item.next().after(item);
                that.options.update();
            }
        });

        // 删除一个
        this.$elem.on("click", ".easy-upload-image-item-icon-trash", function () {
            $(this).closest(".easy-upload-image-item").remove();
            that.toggleButton();
            that.viewer.update();
            that.options.update();
        });
    };

    /**
     * 创建基础DOM
     */
    UploadImage.prototype.create = function () {

        var html = "";

        html += '<div class="easy-upload-image">';
        html += '    <div class="easy-upload-image-list"></div>';
        html += '    <div class="easy-upload-image-btn">';
        html += '        <button type="button"><i class="fa-fw fa-regular fa-image"></i></button>';
        html += '    </div>';
        html += '</div>';

        this.$elem.html(html);
    };

    /**
     * 初始化上传操作
     */
    UploadImage.prototype.init = function () {

        var that = this;

        this.uploader = upload.render({
            elem: this.$elem.find(".easy-upload-image-btn button").get(0),
            url: this.options.url,
            size: this.options.size,
            data: this.options.append,
            field: this.options.name,
            multiple: this.options.multiple,
            before: function (obj) {
                typeof that.options.before === "function" && that.options.before(obj);
            },
            allDone: function (obj) {
                typeof that.options.allDone === "function" && that.options.allDone(obj);
            },
            done: function (result) {
                if (result.code === 1) {
                    that.append(result.data.viewPath);
                    typeof that.options.done === "function" && that.options.done(result.data.viewPath);
                } else {
                    top.layer.alert(result.msg, {
                        icon: 2
                    })
                }
            },
            error: function () {
                typeof that.options.error === "function" && that.options.error();
            }
        });
    };

    /**
     * 追加上传图片
     * @param url
     */
    UploadImage.prototype.append = function (url) {

        var html = "";
        var list = this.$elem.find(".easy-upload-image-list");

        html += '<div class="easy-upload-image-item">';
        html += '    <div class="easy-upload-image-item-icon">';
        html += '        <span class="easy-upload-image-item-icon-left fa fa-fw fa-circle-arrow-left"></span>';
        html += '        <span class="easy-upload-image-item-icon-right fa fa-fw fa-circle-arrow-right"></span>';
        html += '        <span class="easy-upload-image-item-icon-trash fa fa-fw fa-trash"></span>';
        html += '    </div>';
        html += '    <img src="' + url + '" alt="">';
        html += '</div>';

        if (list.find(".easy-upload-image-item").length + 1 > this.options.number) {
            layer.alert("最多允许上传 " + this.options.number + "张", {
                icon: 2
            });
        } else {
            list.append(html);
        }
        this.toggleButton();
        this.viewer.update();
    };

    /**
     * 清空已上传的图片
     */
    UploadImage.prototype.clear = function () {
        this.$elem.find(".easy-upload-image-list").empty();
        this.toggleButton();
        this.viewer.update();
    };

    /**
     * 删除指定索引图片
     * @param index
     */
    UploadImage.prototype.delete = function (index) {
        this.$elem.find(".easy-upload-image-list .easy-upload-image-item").eq(index).remove();
        this.toggleButton();
        this.viewer.update();
    };

    /**
     * 切换显示和隐藏上传按钮
     */
    UploadImage.prototype.toggleButton = function () {
        if (this.$elem.find(".easy-upload-image-item").length >= this.options.number) {
            this.$elem.find(".easy-upload-image-btn").hide();
        } else {
            this.$elem.find(".easy-upload-image-btn").show();
        }
    };

    /**
     * 获取全部已上传的文件
     * @returns {[]}
     */
    UploadImage.prototype.getAll = function () {
        var result = [];
        var list = this.$elem.find(".easy-upload-image-item img");

        for (var i = 0; i < list.length; i++) {
            result.push($(list[i]).attr("src"));
        }

        return result;
    };

    /**
     * 工厂模式
     */
    var uploadImage = {
        render: function (options) {
            return new UploadImage(options);
        }
    };

    layui.link(layui.cache.base + "uploadImage/uploadImage.css");

    exports("uploadImage", uploadImage);
});