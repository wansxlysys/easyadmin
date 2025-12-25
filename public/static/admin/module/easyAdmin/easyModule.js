layui.define([
    'easyAdmin', 'easyCreate', 'easyHelper', 'easyBuilder', 'easyService', 'easyLayout',
    'easyUpload', 'easyMap'
], function (exports) {

    const easyAdmin = layui.easyAdmin;
    const easyLayout = layui.easyLayout;
    const easyUpload = layui.easyUpload;

    /**
     * 移除弹出层透明背景
     */
    easyAdmin.resetFrame();

    /**
     * 暴漏全局
     */
    window.easyLayout = easyLayout;

    /**
     * 导出
     */
    exports("easyModule", {});
});