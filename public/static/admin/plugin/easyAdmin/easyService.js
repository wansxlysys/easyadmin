layui.define(['easyAdmin', 'easyBuilder', 'jquery'], function (exports) {

    var $ = layui.$;
    var easyAdmin = layui.easyAdmin;
    var easyBuilder = layui.easyBuilder;

    // 渲染器
    var render = {
        menuTreeSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllMenu,
                loading: false,
                success: function (result) {

                    var defaults = {
                        appendFirst: true,
                        appendFirstData: {id: 0, title: '顶级菜单', parent_id: 0}
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
                            title: item.title,
                            parent_id: item.parent_id
                        }
                    });

                    easyBuilder.treeStruct(options.elem, data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        siteTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllSite,
                loading: false,
                success: function (result) {

                    var defaults = {
                        appendFirst: true,
                        appendFirstData: {id: 0, title: '顶级菜单', parent_id: 0}
                    };

                    easyBuilder.treeStruct(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        siteSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllSite,
                loading: false,
                success: function (result) {

                    var defaults = {
                        clickClose: false,
                        model: {
                            label: {
                                type: 'block'
                            }
                        }
                    };

                    easyBuilder.singleSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        columnTreeSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getPermissionColumn,
                loading: false,
                data: options.data,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        articleCopyTreeSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllArticleCopy,
                loading: false,
                data: options.data,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        allColumnTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllColumn,
                loading: false,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeStruct(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        columnTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: options.isContribute === true ? apiUrl.getColumnContribute : apiUrl.getPermissionColumn,
                loading: false,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeStruct(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        modelSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllArticleModel,
                loading: false,
                data: options.data,
                success: function (result) {
                    easyBuilder.singleSelect(options.elem, result.data, options.selected, options.setting);
                }
            });
        },
        fieldSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllField,
                loading: false,
                data: options.data,
                success: function (result) {
                    easyBuilder.singleSelect(options.elem, result.data, options.selected, options.setting);
                }
            });
        },
        roleSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllRole,
                loading: false,
                data: options.data,
                success: function (result) {

                    $.each(result.data, function (key, item) {
                        item.parent_id = 0;
                    });

                    easyBuilder.treeSelect(options.elem, result.data, options.selected, options.setting);
                }
            });
        },
        departmentSelect: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllDepartment,
                loading: false,
                data: options.data,
                success: function (result) {

                    var defaults = {
                        appendFirstData: {id: 0, parent_id: 0, title: '顶级部门'}
                    };

                    easyBuilder.treeSelect(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        departmentTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllDepartment,
                loading: false,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeStruct(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        managerTreeStruct: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getAllManagerTree,
                loading: false,
                data: options.data,
                success: function (result) {

                    var defaults = {};

                    easyBuilder.treeStruct(options.elem, result.data, options.selected, $.extend(true, defaults, options.setting));
                }
            });
        },
        articleFlagCheckbox: function (options) {
            easyAdmin.http({
                type: "GET",
                url: apiUrl.getArticleFlag,
                loading: false,
                data: options.data,
                success: function (result) {

                    options.data = result.data;
                    options.title = "title";

                    easyBuilder.arrayCheckbox(options);
                }
            });
        },
    };

    exports("easyService", {
        render: render,
    });
});