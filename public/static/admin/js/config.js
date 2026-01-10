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
        $(elem).next().find('.layui-table-main tr').each((index, item) => {
            $(".layui-table-fixed .layui-table-body tbody tr").eq(index).height($(item).height());
        });
    }

    /**
     * 初始化全局配置
     */
    layui.config({
        base: basePath,
        version: true
    }).extend({
        easyMap: "easyAdmin/easyMap",
        easyAdmin: "easyAdmin/easyAdmin",
        easyHelper: "easyAdmin/easyHelper",
        easyService: "easyAdmin/easyService",
        easyBuilder: "easyAdmin/easyBuilder",
        easyLayout: "easyAdmin/easyLayout",
        easyUpload: "easyAdmin/easyUpload",
        easyCreate: "easyAdmin/easyCreate",
        easyModule: "easyAdmin/easyModule",
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