(function () {

    /**
     * 资源目录路径
     */
    const basePath = window.location.origin + '/static/admin/module/';

    /**
     * 修复表格行高
     * @param elem
     */
    function fixTableRowHeight(elem) {
        jQuery(elem).next().find('.layui-table-main tr').each((index, item) => {
            jQuery(".layui-table-fixed .layui-table-body tbody tr").eq(index).height(jQuery(item).height());
        });
    }

    /**
     * 初始化全局配置
     */
    layui.config({
        base: basePath,
        version: true
    }).extend({
        oneMap: "oneAdmin/oneMap",
        oneAdmin: "oneAdmin/oneAdmin",
        oneHelper: "oneAdmin/oneHelper",
        oneService: "oneAdmin/oneService",
        oneBuilder: "oneAdmin/oneBuilder",
        oneLayout: "oneAdmin/oneLayout",
        oneUpload: "oneAdmin/oneUpload",
        oneCreate: "oneAdmin/oneCreate",
        oneRewrite: "oneAdmin/oneRewrite",
        oneModule: "oneAdmin/oneModule",
        xmSelect: "xmSelect/xmSelect",
        layCascader: "layCascader/layCascader",
    });

    /**
     * 弹窗默认配置
     */
    layui.layer.config({
        shade: 0.3,
        anim: 5,
        isOutAnim: false
    });

    /**
     * 表格默认参数
     */
    layui.table.set({
        page: true,
        scrollPos: 'reset',
        parseData(result) {
            return {
                msg: result.msg,
                code: result.code,
                list: result.data.list,
                total: result.data.total
            };
        },
        limit: 15,
        limits: [15, 30, 45, 60, 75, 90, 100],
        response: {
            msgName: 'msg',
            statusCode: 1,
            dataName: 'list',
            countName: 'total',
            statusName: 'code'
        },
        done() {
            fixTableRowHeight(this.elem);
        }
    });

    layui.treeTable.set({
        page: true,
        parseData(result) {
            return {
                msg: result.msg,
                code: result.code,
                list: result.data.list,
                total: result.data.total
            };
        },
        limit: 15,
        limits: [15, 30, 45, 60, 75, 90, 100],
        response: {
            msgName: 'msg',
            statusCode: 1,
            dataName: 'list',
            countName: 'total',
            statusName: 'code'
        },
        done() {
            fixTableRowHeight(this.elem);
        }
    });

})();