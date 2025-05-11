layui.define(function (exports) {

    const easyAdmin = {};

    /**
     * 打开加载等待
     * @returns {*}
     */
    easyAdmin.showLoading = () => {

        let html = `
            <div class="easy-loading">
                <i class='layui-icon layui-icon-loading-1 layui-anim layui-anim-rotate layui-anim-loop'></i>
                <p>加载中</p>
            </div> 
        `;

        return top.layer.msg(html, {
            time: 0,
            shade: 0.3
        });
    }

    /**
     * 打开一个子iframe页面
     * @param options
     * @returns {s.index}
     */
    easyAdmin.openFrame = (options) => {

        let defaults = {
            title: false,
            type: 2,
            shade: 0,
            closeBtn: 0,
            area: ['100%', '100%'],
            skin: "easy-frame easy-frame-transparent",
            scrollbar: false
        };

        return layer.open($.extend(true, defaults, options));
    }

    /**
     * 关闭当前弹出层
     */
    easyAdmin.closeFrame = () => {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    }

    /**
     * 删除弹出层透明类
     */
    easyAdmin.resetFrame = () => {
        $(window.parent.document).find('.easy-frame').removeClass('easy-frame-transparent');
    }

    /**
     * get请求
     * @param config
     */
    easyAdmin.ajaxGet = (config) => {

        let defaults = {
            type: 'GET'
        }

        easyAdmin.ajaxHttp($.extend(true, defaults, config));
    }

    /**
     * post请求
     * @param config
     */
    easyAdmin.ajaxPost = (config) => {

        let defaults = {
            type: 'POST'
        }

        easyAdmin.ajaxHttp($.extend(true, defaults, config));
    }

    /**
     * http请求
     * @param config
     */
    easyAdmin.ajaxHttp = (config) => {

        let defaults = {
            url: "",
            data: {},
            type: "GET",
            alert: true,
            loading: true,
        };

        let loading = null;
        let options = $.extend(true, defaults, config);

        if (options.loading) {
            loading = easyAdmin.showLoading();
        }

        options.success = (result) => {
            if (result.code === 1) {
                config.success && config.success(result);
            } else {
                config.error && config.error(result);
                if (options.alert) {
                    top.layer.alert(result.msg, {
                        icon: 2
                    });
                }
            }
        }

        options.error = (error) => {
            top.layer.alert(`${error.status} ${error.statusText}`, {
                icon: 2
            });
        }

        options.complete = () => {
            config.complete && config.complete();
            top.layer.close(loading);
        }

        $.ajax(options);
    }

    exports("easyAdmin", easyAdmin);
});