layui.define([
    'easyAdmin', 'easyCreate', 'easyHelper', 'easyBuilder', 'easyService', 'easyLayout',
    'easyUpload', 'easyMap', 'easyRewrite'
], function (exports) {

    const easyAdmin = layui.easyAdmin;
    const easyLayout = layui.easyLayout;
    const easyRewrite = layui.easyRewrite;

    /**
     * 移除弹出层透明背景
     */
    easyAdmin.resetFrame();

    /**
     * 初始化重写
     */
    easyRewrite.rewriteTable();
    easyRewrite.rewriteTreeTable();

    /**
     * 暴漏全局
     */
    window.easyLayout = easyLayout;

    /**
     * 导出
     */
    exports("easyModule", {});
});