layui.define(['easyAdmin', 'easyBuilder', 'jquery', 'laydate', 'easyUpload'], function (exports) {

    const laydate = layui.laydate;
    const easyUpload = layui.easyUpload;
    const easyBuilder = layui.easyBuilder;

    /**
     * 面板分割
     */
    $('.easy-split').each(function () {

        let direction = $(this).data('direction');

        let elem = [];
        let size = [];

        $(this).find('.split-item').each(function () {
            elem.push(this);
            size.push($(this).data('size'));
        });

        $(this).addClass('split-' + direction);

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
    $(".easy-ueditor").each(function () {
        easyBuilder.UEditor({
            elem: this
        });
    });

    /**
     * 单图上传
     */
    $(".layui-builder-image").each(function (key, item) {
        easyUpload.uploadImage({
            elem: $(item)
        }, {
            maxNum: 1,
            multiple: false
        });
    });

    /**
     * 多图上传
     */
    $(".layui-builder-picture").each(function (key, item) {
        easyUpload.uploadImage({
            elem: $(item)
        }, {
            maxNum: $(item).data("max") || Infinity,
            multiple: true
        });
    });

    /**
     * 文件上传
     */
    $(".easy-builder-upload").each((key, item) => {
        easyUpload.uploadFile({
            elem: $(item)
        }, {
            multiple: true,
            maxNum: $(item).data("max") || Infinity,
        });
    });

    /**
     * alert关闭控制
     */
    $(document).on('click', '.easy-alert-close', function () {
        $(this).closest(".easy-alert").remove();
    });

    /**
     * 关闭当前所在弹出层
     */
    $(document).on('click', '.easy-close-layer', function () {
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    });

    /**
     * 日期选择器
     */
    $(document).on('click', '.easy-build-date', function () {
        laydate.render({
            elem: this,
            show: true
        });
    });

    /**
     * 时间选择器
     */
    $(document).on('click', '.easy-build-time', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'time',
        });
    });

    /**
     * 日期时间选择器
     */
    $(document).on('click', '.easy-build-datetime', function () {
        laydate.render({
            elem: this,
            show: true,
            type: 'datetime',
        });
    });

    /**
     * 创建预览图片
     */
    $(".easy-preview").each((key, item) => {
        const picture = $(item).data("picture");
        if (picture) {
            const srcList = picture.split(',');

            srcList.forEach(image => {
                $(item).append('<img src="' + image + '">');
            });

            $(item).find('img').click(event => {
                top.layer.photos({
                    photos: {
                        start: $(event.target).index(),
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
     * 导出
     */
    exports("easyCreate", {});
});