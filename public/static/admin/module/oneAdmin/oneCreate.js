layui.define(['oneAdmin', 'oneBuilder', 'jquery', 'laydate', 'oneUpload'], function (exports) {

    const laydate = layui.laydate;
    const oneUpload = layui.oneUpload;
    const oneBuilder = layui.oneBuilder;

    /**
     * 面板分割
     */
    jQuery('.one-split').each(function () {

        let direction = jQuery(this).data('direction');

        let elem = [];
        let size = [];

        jQuery(this).find('.split-item').each(function () {
            elem.push(this);
            size.push(jQuery(this).data('size'));
        });

        jQuery(this).addClass('split-' + direction);

        Split(elem, {
            sizes: size,
            minSize: 200,
            gutterSize: 6,
            direction: direction
        });
    });

    /**
     * 富文本编辑器
     */
    jQuery(".one-ueditor").each(function () {
        oneBuilder.UEditor({
            elem: this
        });
    });

    /**
     * 单图上传
     */
    jQuery(".layui-builder-image").each(function (key, item) {
        oneUpload.uploadImage({
            elem: jQuery(item)
        }, {
            maxNum: 1,
            multiple: false
        });
    });

    /**
     * 多图上传
     */
    jQuery(".layui-builder-picture").each(function (key, item) {
        oneUpload.uploadImage({
            elem: jQuery(item)
        }, {
            maxNum: jQuery(item).data("max") || Infinity,
            multiple: true
        });
    });

    /**
     * 文件上传
     */
    jQuery(".one-builder-upload").each((key, item) => {
        oneUpload.uploadFile({
            elem: jQuery(item)
        }, {
            multiple: true,
            maxNum: jQuery(item).data("max") || Infinity,
        });
    });

    /**
     * alert关闭控制
     */
    jQuery(document).on('click', '.one-alert-close', function () {
        jQuery(this).closest(".one-alert").remove();
    });

    /**
     * 关闭当前所在弹出层
     */
    jQuery(document).on('click', '.one-close-layer', function () {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    });

    /**
     * 日期选择器
     */
    jQuery(document).on('click', '.one-build-date', function () {
        laydate.render({
            elem: this,
            show: true
        });
    });

    /**
     * 时间选择器
     */
    jQuery(document).on('click', '.one-build-time', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'time',
        });
    });

    /**
     * 日期时间选择器
     */
    jQuery(document).on('click', '.one-build-datetime', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'datetime',
        });
    });

    /**
     * 创建预览图片
     */
    jQuery(".one-preview").each((key, item) => {
        const picture = jQuery(item).data("picture");
        if (picture) {
            const srcList = picture.split(',');

            srcList.forEach(image => {
                jQuery(item).append('<img src="' + image + '">');
            });

            jQuery(item).find('img').click(event => {
                top.layer.photos({
                    photos: {
                        start: jQuery(event.target).index(),
                        data: srcList.map(item => {
                            return {
                                src: item
                            }
                        })
                    }
                });
            });
        }
    });


    /**
     * 文本复制
     */
    const clipboard = new ClipboardJS('.one-copy', {
        text: function (trigger) {
            return jQuery(trigger).attr('data-text');
        }
    });

    clipboard.on('success', function (event) {
        top.layer.msg('复制成功');
        event.clearSelection();
    });

    clipboard.on('error', function () {
        top.layer.msg('复制失败，请手动复制');
    });

    /**
     * 导出
     */
    exports("oneCreate", {});
});