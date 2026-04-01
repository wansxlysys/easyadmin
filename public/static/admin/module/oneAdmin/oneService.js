layui.define(['oneAdmin', 'oneBuilder'], function (exports) {

    const oneAdmin = layui.oneAdmin;
    const oneBuilder = layui.oneBuilder;

    const oneService = {};

    /**
     * 菜单树形选择器
     * @param options
     * @param setting
     */
    oneService.menuTreeSelect = (options, setting) => {
        oneAdmin.ajaxGet({
            loading: false,
            url: apiUrl.getAllMenu,
            success(result) {

                let defaultOptions = {
                    append: {
                        menuId: 0,
                        name: '顶级菜单'
                    },
                    prop: {
                        idKey: 'menuId',
                        pidKey: 'parentId'
                    }
                };

                let defaultSetting = {
                    prop: {
                        value: 'menuId'
                    }
                };

                oneBuilder.treeSelect(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    /**
     * 菜单树形结构
     * @param options
     * @param setting
     */
    oneService.menuTreeStruct = (options, setting) => {
        oneAdmin.ajaxGet({
            loading: false,
            url: apiUrl.getAllMenu,
            success(result) {

                let defaultOptions = {
                    prop: {
                        idKey: 'menuId',
                        pidKey: 'parentId'
                    }
                };

                let defaultSetting = {
                    data: {
                        simpleData: {
                            idKey: 'menuId'
                        }
                    },
                };

                oneBuilder.treeStruct(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    /**
     * 角色单项选择器
     * @param options
     * @param setting
     */
    oneService.roleSingleSelect = (options, setting) => {
        oneAdmin.ajaxGet({
            loading: false,
            url: apiUrl.getAllRole,
            success(result) {

                let defaultOptions = {
                    single: true,
                    prop: {
                        idKey: 'roleId'
                    }
                };

                let defaultSetting = {
                    prop: {
                        value: 'roleId'
                    }
                };

                oneBuilder.treeSelect(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    exports("oneService", oneService);
});