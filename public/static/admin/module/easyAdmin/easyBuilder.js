layui.define(['easyHelper', 'jquery', 'form', 'xmSelect'], function (exports) {

    var form = layui.form;
    var dropdown = layui.dropdown;
    var xmSelect = layui.xmSelect;
    var easyHelper = layui.easyHelper;

    const easyBuilder = {};

    /**
     * 获取所有父级元素ID
     * @param data
     * @param id
     * @returns {*[]}
     */
    function getParentsId(data, id) {
        return easyHelper.objectColumn(easyHelper.getParents(data, id), "id");
    }

    /**
     * 创建树结构选择器
     * @param options
     * @param setting
     * @param data
     */
    easyBuilder.treeStruct = (options, setting, data) => {

        var defaultOptions = {
            checked: ''
        }

        let defaultSetting = {
            data: {
                key: {
                    name: 'name'
                },
                simpleData: {
                    enable: true,
                    pIdKey: "parent_id",
                    rootPId: 0
                }
            },
            check: {
                enable: false
            }
        };

        options = Object.assign(defaultOptions, options);
        setting = Object.assign(defaultSetting, setting);

        if (options.checked) {
            options.checked.split(',').map(item => +item);
        } else {
            options.checked = [];
        }

        data.forEach(item => {
            item.icon = null;
            item.checked = options.checked.includes(item.id);
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
            checked: ''
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

        options = Object.assign(defaultOptions, options);
        setting = Object.assign(defaultSetting, setting);

        if (options.append) {
            setting.data = setting.data.concat(options.append);
        }

        if (options.single) {
            setting.data.forEach(item => {
                item.selected = item.id == options.checked;
            });
        } else {
            setting.tree.expandedKeys = getParentsId(setting.data, options.checked);
            setting.data = easyHelper.arrayToTree(setting.data, (item) => {
                item.selected = item.id == options.checked;
            });
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
            show: true,
            align: 'right',
            className: 'easy-menu'
        };

        const configs = Object.assign(defaults, options);

        configs.data.forEach(item => {
            item.templet = `<i class="fa fa-fw ${item.icon}"></i><span>{{d.title}}</span>`;
        });

        dropdown.render(configs);
    }

    exports("easyBuilder", easyBuilder);
});