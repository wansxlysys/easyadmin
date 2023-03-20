layui.define(['easyAdmin', 'jquery', 'laydate', 'uploadImage'], function (exports) {

    var $ = layui.$;
    var laydate = layui.laydate;
    var easyAdmin = layui.easyAdmin;
    var uploadImage = layui.uploadImage;

    /**
     * alert关闭控制
     */
    $(".easy-alert-close").click(function () {
        $(this).closest(".easy-alert").remove();
    });

    /**
     * 返回上一级
     */
    $(".easy-history-back").click(function () {
        window.history.back();
    });

    /**
     * 关闭当前所在弹出层
     */
    $(".easy-close-this-layer").click(function () {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    });

    /**
     * 书组件选中
     */
    $("body").on("click", ".layui-tree-txt", function () {
        $(this).closest(".layui-tree-default").find(".layui-tree-active").removeClass("layui-tree-active");
        $(this).addClass("layui-tree-active");
    });

    /**
     * 富文本编辑器
     */
    $(".layui-builder-ueditor").each(function (key, item) {
        UE.getEditor($(item).attr("id"));
    });

    /**
     * 日期选择器
     */
    $(".layui-builder-date").each(function (key, item) {
        laydate.render({
            elem: $(item).get(0),
            done: function (value) {
                // 修复取值为上次选择的值
                $(item).val(value);
                // 修复js动态修改无法监听到change事件问题
                $(item).trigger("change");
            }
        });
    });

    /**
     * 时间选择器
     */
    $(".layui-builder-time").each(function (key, item) {
        laydate.render({
            elem: $(item).get(0),
            type: "time",
            done: function (value) {
                // 修复取值为上次选择的值
                $(item).val(value);
                // 修复js动态修改无法监听到change事件问题
                $(item).trigger("change");
            }
        });
    });

    /**
     * 日期时间选择器
     */
    $(".layui-builder-datetime").each(function (key, item) {
        laydate.render({
            elem: $(item).get(0),
            type: "datetime",
            done: function (value) {
                // 修复取值为上次选择的值
                $(item).val(value);
                // 修复js动态修改无法监听到change事件问题
                $(item).trigger("change");
            }
        });
    });

    /**
     * 日期时间范围选择器
     */
    $(".layui-builder-datetime-range").each(function (key, item) {
        laydate.render({
            elem: $(item).get(0),
            type: "datetime",
            range: true,
            done: function (value) {
                // 修复取值为上次选择的值
                $(item).val(value);
                // 修复js动态修改无法监听到change事件问题
                $(item).trigger("change");
            }
        });
    });

    /**
     * 单图上传
     */
    $(".layui-builder-image").each(function (key, item) {
        (function () {
            var name = $(item).attr("name");
            var value = $(item).val();
            var loading = null;
            var uploader = name + 'Uploader';

            window[uploader] = uploadImage.render({
                elem: "#" + name,
                name: "file",
                number: 1,
                multiple: true,
                url: globals.uploadImage,
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
            var uploader = name + 'Uploader';

            window[uploader] = uploadImage.render({
                elem: "#" + name,
                name: "file",
                number: 10,
                multiple: true,
                url: globals.uploadImage,
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
     * 导出
     */
    exports("easyCreate", {});
});