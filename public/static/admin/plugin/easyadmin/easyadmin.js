layui.define(["jquery", "uploadImage"], function (exports) {

    var $ = layui.$;
    var uploadImage = layui.uploadImage;

    var Easyadmin = {
        /**
         * http请求
         * @param options
         */
        http: function (options) {

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

            var config = $.extend({}, defaults, options);

            var key = '';
            if (config.loading) {
                key = this.loading();
            }

            $.ajax({
                type: config.type,
                url: config.url,
                data: config.data,
                success: function (result) {
                    if (result.code === 1) {
                        typeof config.success == 'function' && config.success(result);
                    } else {
                        typeof config.error == 'function' && config.error(result);
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
                    typeof config.complete == 'function' && config.complete();
                    top.layer.close(key);
                }
            });
        },

        /**
         * layui加载等待
         * @returns {*}
         */
        loading: function () {

            var html = '';

            html += "<p style='color:#fff'>";
            html += "<i class='layui-icon layui-icon-loading-1 layui-anim layui-anim-rotate layui-anim-loop' style='font-size:28px;color:#fff'></i>";
            html += "<br>加载中</p>";

            return top.layer.msg(html, {
                time: 10000000,
                shade: 0.3
            });
        },
        /**
         * layui树组件扩展，获取选中节点ID
         * @param tree
         * @returns {[]}
         */
        treeToArray: function (tree) {
            var result = [];
            var getChild = function (tree) {
                for (var i = 0; i < tree.length; i++) {
                    if (tree[i].children.length > 0) {
                        getChild(tree[i].children);
                    }
                    result.push(tree[i]);
                }
                return result;
            };
            return getChild(tree);
        },
        /**
         * 获取对象的某一列
         * @param data
         * @param field
         * @returns {[]}
         */
        objectColumn(data, field) {
            var result = [];
            for (var i = 0; i < data.length; i++) {
                result.push(data[i][field]);
            }
            return result;
        },
        /**
         * 打开一个子iframe页面
         * @param options
         * @returns {s.index}
         */
        open: function (options) {
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

            var config = $.extend({}, defaults, options);
            return layer.open(config);
        },
        /**
         * 关闭当前弹出层
         */
        close: function () {
            parent.layer.close(parent.layer.getFrameIndex(window.name));
        }
    };

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
                    loading = Easyadmin.loading();
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
                    loading = Easyadmin.loading();
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
    exports("easyadmin", Easyadmin);
});