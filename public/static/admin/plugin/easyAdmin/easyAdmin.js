layui.define(['jquery'], function (exports) {

    var $ = layui.$;

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
            skin: "easy-iframe easy-iframe-transparent",
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
     * 删除弹出层透明类
     */
    function removeLayerClass() {
        $(window.parent.document).find('.easy-iframe-transparent').removeClass('easy-iframe-transparent');
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
     * 导出
     */
    exports("easyAdmin", {
        http: http,
        openLayer: openLayer,
        closeLayer: closeLayer,
        showLoading: showLoading,
        removeLayerClass: removeLayerClass
    });
});