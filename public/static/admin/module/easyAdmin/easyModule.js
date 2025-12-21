layui.define(['easyAdmin', 'easyCreate', 'easyHelper', 'easyBuilder', 'easyService', 'easyLayout', 'easyMap'], function (exports) {

    const easyAdmin = layui.easyAdmin;
    const easyLayout = layui.easyLayout;

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