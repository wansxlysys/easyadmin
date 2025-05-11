layui.define(['easyHelper', 'xmSelect', 'layCascader'], function (exports) {

    const dropdown = layui.dropdown;
    const xmSelect = layui.xmSelect;
    const easyHelper = layui.easyHelper;
    const layCascader = layui.layCascader;

    const easyBuilder = {};

    /**
     * 创建树结构选择器
     * @param options
     * @param setting
     * @param data
     */
    easyBuilder.treeStruct = (options, setting, data) => {

        const defaultOptions = {
            elem: '',
            checked: ''
        }

        let defaultSetting = {
            data: {
                key: {
                    name: 'name'
                },
                simpleData: {
                    enable: true,
                    idKey: 'id',
                    pIdKey: 'parentId',
                    rootPId: 0
                }
            },
            check: {
                enable: false
            }
        };

        options = $.extend(true, defaultOptions, options);
        setting = $.extend(true, defaultSetting, setting);

        if (options.checked) {
            options.checked = options.checked.split(',').map(item => +item);
        } else {
            options.checked = [];
        }

        data.forEach(item => {
            item.icon = null;
            item.checked = options.checked.includes(item[setting.data.simpleData.idKey]);
        });

        let tree = $.fn.zTree.init($(options.elem), setting, data);

        if (options.ready) {
            options.ready(tree);
        }
    }

    /**
     * 构建树形选择器
     * @param options
     * @param data
     * @param setting
     */
    easyBuilder.treeSelect = (options, setting, data) => {

        const defaultOptions = {
            elem: '',
            checked: '',
            prop: {
                idKey: 'id',
                pidKey: 'parentId'
            }
        }

        const defaultSetting = {
            el: options.elem,
            data: data,
            radio: true,
            clickClose: true,
            height: "450px",
            disabled: false,
            prop: {
                name: 'name',
                value: 'id'
            },
            model: {
                icon: 'hidden',
                label: {
                    type: 'text'
                }
            },
            theme: {
                color: "#5FB878"
            },
            tree: {
                show: true,
                showFolderIcon: true,
                showLine: false,
                expandedKeys: [],
                strict: false,
                clickExpand: false,
                clickCheck: true
            }
        };

        options = $.extend(true, defaultOptions, options);
        setting = $.extend(true, defaultSetting, setting);

        if (options.append) {
            setting.data.unshift(options.append);
        }

        if (options.single) {
            setting.data.forEach(item => {
                item.selected = item[options.prop.idKey] == options.checked;
            });
        } else {
            setting.tree.expandedKeys = [options.checked];
            setting.data = easyHelper.arrayToTree({
                prop: {
                    idKey: options.prop.idKey,
                    pidKey: options.prop.pidKey
                },
                handler: (item) => {
                    item.selected = item[options.prop.idKey] == options.checked;
                }
            }, setting.data);
        }

        const treeSelect = xmSelect.render(setting);

        if (options.ready) {
            options.ready(treeSelect);
        }
    }

    /**
     * 创建下拉菜单
     * @param options
     */
    easyBuilder.dropMenu = (options) => {

        const defaults = {
            show: false,
            align: 'right',
            className: 'easy-menu'
        };

        options = $.extend(true, defaults, options);

        options.data.forEach(item => {
            item.templet = `<i class="fa fa-fw ${item.icon}"></i><span>{{d.title}}</span>`;
        });

        dropdown.render(options);
    }

    /**
     * 联级选择器
     * @param options
     * @param setting
     * @param data
     * @constructor
     */
    easyBuilder.cascader = (options, setting, data) => {

        const defaultOptions = {
            elem: '',
            checked: [],
            prop: {
                idKey: 'id',
                pidKey: 'parentId'
            }
        }

        const defaultSetting = {
            elem: options.elem,
            clearable: true,
            props: {
                value: 'id',
                label: 'name',
                strictMode: true
            }
        };

        options = $.extend(true, defaultOptions, options);
        setting = $.extend(true, defaultSetting, setting);

        if (!options.checked) {
            options.checked = [];
        }

        if (Array.isArray(options.checked)) {
            setting.value = options.checked.map(val => +val);
        } else {
            setting.value = options.checked.split(',').map(val => +val);
        }

        setting.options = easyHelper.arrayToTree({
            prop: {
                idKey: options.prop.idKey,
                pidKey: options.prop.pidKey
            }
        }, data);

        const cascader = layCascader(setting);

        if (options.ready) {
            options.ready(cascader);
        }
    }

    /**
     * 富文本编辑器
     * @param options
     * @param setting
     * @constructor
     */
    easyBuilder.UEditor = (options, setting) => {

        const defaultOptions = {
            elem: ''
        };

        const defaultSetting = {
            serverUrl: apiUrl.ueditor,
            initialFrameWidth: '100%',
            initialFrameHeight: '500',
            imageConfig: {
                disableOnline: true
            },
            catchRemoteImageEnable: false,
            toolbars: [[
                "fullscreen", "source", "|", "undo", "redo", "bold", "italic", "underline", "fontborder",
                "strikethrough", "superscript", "subscript", "removeformat", "formatmatch",
                "autotypeset", "blockquote", "pasteplain", "|", "forecolor", "backcolor",
                "insertorderedlist", "insertunorderedlist", "|", "rowspacingtop", "rowspacingbottom",
                "lineheight", "|", "paragraph", "fontfamily", "fontsize", "indent", "justifyleft",
                "justifycenter", "justifyright", "justifyjustify", "|", "link", "anchor", "|",
                "simpleupload", "insertimage", "insertvideo", "insertaudio", "attachment", "insertframe",
                "inserttable", "insertcode", "background", "|", "horizontal", "date", "time", "spechars",
                "print", "searchreplace",
            ]]
        };

        options = $.extend(true, defaultOptions, options);
        setting = $.extend(true, defaultSetting, setting);

        UE.getEditor(options.elem, setting);
    }

    exports("easyBuilder", easyBuilder);
});