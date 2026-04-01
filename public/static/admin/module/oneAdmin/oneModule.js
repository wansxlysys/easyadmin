layui.define([
    'oneAdmin', 'oneCreate', 'oneHelper', 'oneBuilder', 'oneService', 'oneLayout',
    'oneUpload', 'oneMap', 'oneRewrite'
], function (exports) {

    const oneAdmin = layui.oneAdmin;
    const oneLayout = layui.oneLayout;
    const oneRewrite = layui.oneRewrite;

    /**
     * 移除弹出层透明背景
     */
    oneAdmin.resetFrame();

    /**
     * 初始化重写
     */
    oneRewrite.rewriteTable();
    oneRewrite.rewriteTreeTable();

    /**
     * 暴漏全局
     */
    window.oneLayout = oneLayout;

    /**
     * 导出
     */
    exports("oneModule", {});
});