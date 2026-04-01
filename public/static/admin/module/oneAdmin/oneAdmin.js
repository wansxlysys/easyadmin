layui.define(function (exports) {

    const oneAdmin = {};

    /**
     * 打开加载等待
     * @returns {*}
     */
    oneAdmin.showLoading = () => {

        let html = `
            <div class="one-loading">
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
    oneAdmin.openFrame = (options) => {

        let defaults = {
            title: false,
            type: 2,
            shade: 0,
            closeBtn: 0,
            area: ['100%', '100%'],
            skin: "one-frame one-frame-transparent",
            scrollbar: false
        };

        return layer.open(jQuery.extend(true, defaults, options));
    }

    /**
     * 关闭当前弹出层
     */
    oneAdmin.closeFrame = () => {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    }

    /**
     * 删除弹出层透明类
     */
    oneAdmin.resetFrame = () => {
        jQuery(window.parent.document).find('.one-frame').removeClass('one-frame-transparent');
    }

    /**
     * 删除弹出层透明类
     */
    oneAdmin.openFileLayer = (configs) => {
        top.oneLayout.openFileLayer(configs)
    }

    /**
     * get请求
     * @param config
     */
    oneAdmin.ajaxGet = (config) => {

        let defaults = {
            type: 'GET'
        }

        oneAdmin.ajaxHttp(jQuery.extend(true, defaults, config));
    }

    /**
     * post请求
     * @param config
     */
    oneAdmin.ajaxPost = (config) => {

        let defaults = {
            data: {},
            type: 'POST',
            contentType: 'application/json',
        }

        const setting = jQuery.extend(true, {}, defaults, config);

        if (setting.contentType == defaults.contentType) {
            setting.data = JSON.stringify(setting.data);
        }

        oneAdmin.ajaxHttp(setting);
    }

    /**
     * http请求
     * @param config
     */
    oneAdmin.ajaxHttp = (config) => {

        let defaults = {
            url: "",
            data: {},
            type: "GET",
            alert: true,
            loading: true,
        };

        let loading = null;
        let options = jQuery.extend(true, defaults, config);

        if (options.loading) {
            loading = oneAdmin.showLoading();
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

        jQuery.ajax(options);
    }

    exports("oneAdmin", oneAdmin);
});