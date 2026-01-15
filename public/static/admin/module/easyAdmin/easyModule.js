layui.define([
    'easyAdmin', 'easyCreate', 'easyHelper', 'easyBuilder', 'easyService', 'easyLayout',
    'easyUpload', 'easyMap'
], function (exports) {

    const table = layui.table;
    const easyAdmin = layui.easyAdmin;
    const easyLayout = layui.easyLayout;

    /**
     * 移除弹出层透明背景
     */
    easyAdmin.resetFrame();

    /**
     * 暴漏全局
     */
    window.easyLayout = easyLayout;

    /**
     * 重写表格渲染
     */
    const rewriteTableRender = () => {

        const originRender = table.render;

        table.render = function (config) {

            let tableToolbar = null;

            if (jQuery(config.toolbar).length) {
                tableToolbar = jQuery(config.toolbar).html();
            }

            if (!tableToolbar || !jQuery(tableToolbar).find('button').length) {
                delete config.toolbar;
            }

            config.cols = config.cols.map((rowConfig) => {
                return rowConfig.filter((colConfig) => {
                    if (colConfig.dynamic === true) {
                        let toolbar = null;

                        if (jQuery(colConfig.toolbar).length) {
                            toolbar = jQuery(colConfig.toolbar).html();
                        }

                        const length = jQuery(toolbar).filter('button').length ||
                            jQuery(toolbar).find('button').length;

                        if (toolbar && length) {
                            colConfig.width = length * 75 + 20;
                        }

                        return !(!toolbar || !length);
                    }

                    return true;
                });
            });

            return originRender.call(this, config);
        }
    }

    /**
     * 初始化重写
     */
    rewriteTableRender();

    /**
     * 导出
     */
    exports("easyModule", {});
});