layui.define(['laytpl', 'easyHelper', 'easyAdmin'], function (exports) {

    const laytpl = layui.laytpl;
    const easyAdmin = layui.easyAdmin;
    const easyHelper = layui.easyHelper;

    const easyUpload = {};

    /**
     * 图片上传
     * @param options
     * @param setting
     */
    easyUpload.uploadImage = function (options, setting) {

        const defaultOptions = {
            elem: ''
        }

        const defautlSetting = {
            multiple: true,
            maxNum: Infinity,
            fileType: ['image']
        }

        let imageList = [];

        options = jQuery.extend(true, {}, defaultOptions, options);
        setting = jQuery.extend(true, {}, defautlSetting, setting);

        const initValue = jQuery(options.elem).val();
        const container = jQuery(`<div class="easy-upload-image"></div>`);

        const updateElement = () => {
            const template = `
                <div class="easy-upload-image-list">
                    {{# layui.each(d.imageList, function(index, path){ }}
                    <div class="easy-upload-image-item">
                        <div class="easy-upload-image-item-icon">
                            <span class="easy-upload-image-prev fa fa-fw fa-circle-arrow-left"></span>
                            <span class="easy-upload-image-next fa fa-fw fa-circle-arrow-right"></span>
                            <span class="easy-upload-image-del fa fa-fw fa-trash"></span>
                        </div>
                        <img src="{{path}}">
                    </div>
                    {{#  }); }}
                </div>
                {{# if(d.setting.maxNum > d.imageList.length) { }}
                <div class="easy-upload-image-btn">
                    <button type="button">
                        <i class="fa-fw fa-regular fa-image"></i>
                    </button>
                </div>
                {{# } }}
            `;

            container.html(laytpl(template).render({
                setting: setting,
                imageList: imageList
            }));

            if (imageList.length == 0) {
                jQuery(options.elem).val(null);
            } else {
                jQuery(options.elem).val(imageList.join(','));
            }
        }

        const findItemIndex = (target) => {
            return jQuery(target).closest('.easy-upload-image-item').index();
        }

        if (initValue) {
            imageList = initValue.split(',');
        }

        jQuery(options.elem).after(container);

        container.on('click', '.easy-upload-image-prev', (event) => {
            const index = findItemIndex(event.currentTarget);
            if (index > 0) {
                easyHelper.arraySwap(imageList, index, index - 1);
                updateElement();
            }
        });

        container.on('click', '.easy-upload-image-next', (event) => {
            const index = findItemIndex(event.currentTarget);
            if (index < imageList.length - 1) {
                easyHelper.arraySwap(imageList, index, index + 1);
                updateElement();
            }
        });

        container.on('click', '.easy-upload-image-del', (event) => {
            imageList.splice(findItemIndex(event.currentTarget), 1);
            updateElement();
        });

        container.on('click', '.easy-upload-image-btn', () => {
            easyAdmin.openFileLayer({
                multiple: setting.multiple,
                maxNum: setting.maxNum,
                fileType: setting.fileType,
                selectNum: imageList.length,
                selectFile: function (dataList) {
                    dataList.forEach((data) => {
                        imageList.push(data.path);
                    });
                    updateElement();
                }
            });
        });

        container.on('click', 'img', (event) => {
            const index = findItemIndex(event.currentTarget);
            top.layer.photos({
                photos: {
                    start: index,
                    data: imageList.map((path) => {
                        return {
                            src: path
                        }
                    })
                }
            });
        });

        updateElement();
    };

    /**
     * 文件上传
     * @param options
     * @param setting
     */
    easyUpload.uploadFile = function (options, setting) {

        const defaultOptions = {
            elem: ''
        }

        const defautlSetting = {
            multiple: true,
            maxNum: Infinity,
            fileType: ['image', 'video', 'audio', 'doc', 'zip']
        }

        let fileList = [];

        options = jQuery.extend(true, {}, defaultOptions, options);
        setting = jQuery.extend(true, {}, defautlSetting, setting);

        const initValue = jQuery(options.elem).val();
        const container = jQuery(`<div class="easy-upload-file"></div>`);

        const updateElement = function () {
            const template = `
                {{# if(d.setting.maxNum > d.fileList.length) { }}
                <button type="button" class="layui-btn layui-btn-sm easy-upload-file-btn">
                   <i class="fa fa-fw fa-upload"></i> 选择文件
                </button>
                {{# } }}
                <div class="easy-upload-file-list">
                    {{# layui.each(d.fileList, function(index, item){ }}
                    <div class="easy-upload-file-item">
                        <div class="easy-upload-file-name">{{item.name}}</div>
                        <div class="easy-upload-file-size">{{=d.easyHelper.formatFileSize(item.size)}}</div>
                        <div class="easy-upload-file-tool">
                            <span class="easy-upload-file-prev fa fa-fw fa-circle-arrow-up"></span>
                            <span class="easy-upload-file-next fa fa-fw fa-circle-arrow-down"></span>
                            <span class="easy-upload-file-del fa fa-fw fa-trash"></span>
                        </div>
                    </div>
                    {{#  }); }}
                </div>
            `;

            container.html(laytpl(template).render({
                setting: setting,
                fileList: fileList,
                easyHelper: easyHelper
            }));

            if (fileList.length == 0) {
                jQuery(options.elem).val(null);
            } else {
                jQuery(options.elem).val(JSON.stringify(fileList));
            }
        }

        const findItemIndex = function (target) {
            return jQuery(target).closest('.easy-upload-file-item').index();
        }

        if (initValue) {
            fileList = JSON.parse(inputValue);
        }

        jQuery(options.elem).after(container);

        container.on('click', '.easy-upload-file-prev', (event) => {
            const index = findItemIndex(event.currentTarget);
            if (index > 0) {
                easyHelper.arraySwap(fileList, index, index - 1);
                updateElement();
            }
        });

        container.on('click', '.easy-upload-file-next', (event) => {
            const index = findItemIndex(event.currentTarget);
            if (index < fileList.length - 1) {
                easyHelper.arraySwap(fileList, index, index + 1);
                updateElement();
            }
        });

        container.on('click', '.easy-upload-file-del', (event) => {
            fileList.splice(findItemIndex(event.currentTarget), 1);
            updateElement();
        });

        container.on('click', '.easy-upload-file-btn', () => {
            easyAdmin.openFileLayer({
                multiple: setting.multiple,
                maxNum: setting.maxNum,
                fileType: setting.fileType,
                selectNum: fileList.length,
                selectFile: function (dataList) {
                    dataList.forEach((data) => {
                        fileList.push(data);
                    });
                    updateElement();
                }
            });
        });

        updateElement();
    };

    exports("easyUpload", easyUpload);
});