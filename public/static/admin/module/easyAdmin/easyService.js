layui.define(['easyAdmin', 'easyBuilder'], function (exports) {

    const easyAdmin = layui.easyAdmin;
    const easyBuilder = layui.easyBuilder;

    const easyService = {};

    /**
     * 菜单树形选择器
     * @param options
     * @param setting
     */
    easyService.menuTreeSelect = (options, setting) => {
        easyAdmin.ajaxGet({
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

                easyBuilder.treeSelect(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    /**
     * 菜单树形结构
     * @param options
     * @param setting
     */
    easyService.menuTreeStruct = (options, setting) => {
        easyAdmin.ajaxGet({
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

                easyBuilder.treeStruct(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    /**
     * 角色单项选择器
     * @param options
     * @param setting
     */
    easyService.roleSingleSelect = (options, setting) => {
        easyAdmin.ajaxGet({
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

                easyBuilder.treeSelect(jQuery.extend(true, defaultOptions, options), jQuery.extend(true, defaultSetting, setting), result.data);
            }
        });
    }

    exports("easyService", easyService);
});