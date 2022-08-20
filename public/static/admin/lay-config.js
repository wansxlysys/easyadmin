(function () {

    /**
     * 资源目录路径
     */
    var basePath = document.scripts[document.scripts.length - 1].src.substring(0, src.lastIndexOf("/") + 1);

    /**
     * 初始化全局配置
     */
    layui.config({
        base: basePath + "plugin/",
        version: true
    }).extend({
        xmSelect: "xmSelect/xmSelect",
        easyAdmin: "easyAdmin/easyAdmin",
        easyBuild: "easyAdmin/easyBuild",
        easyHelper: "easyAdmin/easyHelper",
        easyService: "easyAdmin/easyService",
        treeTable: "treeTable/treeTable",
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
        parseData: function (result) {
            return {
                "code": result.code,
                "msg": result.msg,
                "count": result.data.total,
                "lists": result.data.lists
            };
        },
        limit: 15,
        limits: [15, 30, 45, 60, 75, 90, 100],
        response: {
            msgName: 'msg',
            statusCode: 1,
            dataName: 'lists',
            countName: 'count',
            statusName: 'code',
        }
    });

    /**
     * 日期默认主题
     */
    layui.laydate.set({
        theme: "#2d8cf0"
    });

})();