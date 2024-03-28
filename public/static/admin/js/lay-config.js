(function () {

    /**
     * 资源目录路径
     */
    const basePath = window.location.origin + '/static/admin/module/';

    /**
     * 初始化全局配置
     */
    layui.config({
        base: basePath,
        version: true
    }).extend({
        xmSelect: "xmSelect/xmSelect",
        easyAdmin: "easyAdmin/easyAdmin",
        easyCreate: "easyAdmin/easyCreate",
        easyHelper: "easyAdmin/easyHelper",
        easyService: "easyAdmin/easyService",
        easyBuilder: "easyAdmin/easyBuilder",
        easyModule: "easyAdmin/easyModule",
        uploadFile: "uploadFile/uploadFile",
        uploadImage: "uploadImage/uploadImage",
    });

    /**
     * 弹窗默认配置
     */
    layui.layer.config({
        shade: 0.3,
        anim: -1,
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
        }
    });

})();