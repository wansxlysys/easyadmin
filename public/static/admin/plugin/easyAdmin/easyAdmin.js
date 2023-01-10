layui.define(["jquery", "laydate", "uploadImage"], function (exports) {

    var $ = layui.$;
    var laydate = layui.laydate;
    var uploadImage = layui.uploadImage;

    /**
     * 加载等待
     * @returns {*}
     */
    function showLoading() {

        var html = '';

        html += "<p style='color:#fff'>";
        html += "<i class='layui-icon layui-icon-loading-1 layui-anim layui-anim-rotate layui-anim-loop' style='font-size:28px;color:#fff'></i>";
        html += "<br>加载中</p>";

        return top.layer.msg(html, {
            time: 10000000,
            shade: 0.3
        });
    }

    /**
     * 打开一个子iframe页面
     * @param options
     * @returns {s.index}
     */
    function openLayer(options) {
        if (typeof options == 'string') {
            options = {
                content: options
            }
        }

        var defaults = {
            title: false,
            type: 2,
            shade: 0,
            closeBtn: 0,
            area: ['100%', '100%'],
            skin: "easy-iframe-transparent",
            content: "",
        };

        return layer.open($.extend(true, defaults, options));
    }

    /**
     * 关闭当前弹出层
     */
    function closeLayer() {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    }

    /**
     * 发送http请求
     * @param config
     */
    function http(config) {

        var defaults = {
            url: "",
            type: "GET",
            data: {},
            loading: true,
            success: function () {

            },
            error: function () {

            },
            complete: function () {

            }
        };

        var key = '';
        var options = $.extend(true, defaults, config);

        if (options.loading) {
            key = showLoading();
        }

        $.ajax({
            type: options.type,
            url: options.url,
            data: options.data,
            success: function (result) {
                if (result.code === 1) {
                    typeof options.success == 'function' && options.success(result);
                } else {
                    typeof options.error == 'function' && options.error(result);
                    top.layer.alert(result.msg, {
                        icon: 2
                    });
                }
            },
            error: function () {
                top.layer.alert("请求失败", {
                    icon: 2
                });
            },
            complete: function () {
                typeof options.complete == 'function' && options.complete();
                top.layer.close(key);
            }
        });
    }

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
                    loading = showLoading();
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
                    loading = showLoading();
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
    exports("easyAdmin", {
        http: http,
        openLayer: openLayer,
        closeLayer: closeLayer,
        showLoading: showLoading,
    });
});