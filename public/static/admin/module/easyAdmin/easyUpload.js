layui.define(['laytpl', 'easyHelper', 'easyAdmin'], function (exports) {

    const laytpl = layui.laytpl;
    const easyAdmin = layui.easyAdmin;
    const easyHelper = layui.easyHelper;

    const easyUpload = {};

    easyUpload.uploadImage = function (options, setting) {

        const defaultOptions = {
            elem: ''
        }

        const defautlSetting = {
            multiple: true,
            selectMax: Infinity,
            fileType: ['image']
        }

        let imageList = [];

        options = $.extend(true, {}, defaultOptions, options);
        setting = $.extend(true, {}, defautlSetting, setting);

        const container = $(`<div class="easy-upload-image"></div>`);
        const initValue = $(options.elem).val();

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
                {{# if(d.setting.selectMax > d.imageList.length) { }}
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
                $(options.elem).val(null);
            } else {
                const imagePath = imageList.map((image) => {
                    return image.path;
                });
                $(options.elem).val(imagePath.join(','));
            }
        }

        const findItemIndex = (target) => {
            return $(target).closest('.easy-upload-image-item').index();
        }

        if (initValue) {
            imageList = initValue.split(',');
        }

        $(options.elem).after(container);

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
                maxNum: setting.selectMax,
                selectNum: imageList.length,
                fileType: ['image'],
                selectFile: function (fileList) {
                    fileList.forEach(file => {
                        imageList.push(file.path);
                    });
                    updateElement();
                }
            })
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

    exports("easyUpload", easyUpload);
});