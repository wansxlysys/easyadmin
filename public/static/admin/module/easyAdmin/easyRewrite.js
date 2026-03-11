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

                        if (!toolbar) {
                            return false;
                        }

                        const buttonList = jQuery(toolbar).filter('button') || jQuery(toolbar).find('button');

                        if (!buttonList.length) {
                            return false;
                        }

                        colConfig.width = 15;

                        buttonList.each((key, button) => {
                            colConfig.width += parseInt(jQuery(button).attr('dynamic-width')) + 15 || 75;
                        });

                        return true;
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