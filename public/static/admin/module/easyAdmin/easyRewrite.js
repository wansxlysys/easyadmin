layui.define(['table'], function (exports) {

    const table = layui.table;
    const treeTable = layui.treeTable;

    const easyRewrite = {};

    easyRewrite.rewriteLayuiTable = function (table) {

        const originalRender = table.render;

        return table.render = function (config) {

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

            return originalRender.call(this, config);
        }
    }

    /**
     * 重写表格渲染
     */
    easyRewrite.rewriteTable = function () {
        return easyRewrite.rewriteLayuiTable(table);
    }

    /**
     * 重写树形表格渲染
     */
    easyRewrite.rewriteTreeTable = function () {
        return easyRewrite.rewriteLayuiTable(treeTable);
    }

    exports("easyRewrite", easyRewrite);
});