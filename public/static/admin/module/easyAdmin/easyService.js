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
                    append: {id: 0, name: '顶级菜单'}
                };

                let defaultSetting = {};

                easyBuilder.treeSelect(Object.assign(defaultOptions, options), Object.assign(defaultSetting, setting), result.data);
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

                let defaultOptions = {};
                let defaultSetting = {};

                easyBuilder.treeStruct(Object.assign(defaultOptions, options), Object.assign(defaultSetting, setting), result.data);
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
                    single: true
                };

                let defaultSetting = {};

                easyBuilder.treeSelect(Object.assign(defaultOptions, options), Object.assign(defaultSetting, setting), result.data);
            }
        });
    }

    exports("easyService", easyService);
});