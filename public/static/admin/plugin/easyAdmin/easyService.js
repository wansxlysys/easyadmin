layui.define(['easyAdmin', 'easyBuilder', 'jquery'], function (exports) {

    var $ = layui.$;
    var easyAdmin = layui.easyAdmin;
    var easyBuilder = layui.easyBuilder;

    var easyService = {
        menuTreeSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllMenu,
                loading: false,
                success: function (result) {

                    var defaults = {
                        appendFirst: true,
                        appendFirstData: {id: 0, name: '顶级菜单', parent_id: 0}
                    };

                    easyBuilder.treeSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        menuTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllMenu,
                loading: false,
                success: function (result) {

                    var defaults = {};
                    var data = $.map(result.data, function (item) {
                        return {
                            id: item.id,
                            name: item.name,
                            parent_id: item.parent_id
                        }
                    });

                    easyBuilder.treeStruct(options.elem, data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        roleSingleSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllRole,
                loading: false,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.singleSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
    };

    exports("easyService", easyService);
});