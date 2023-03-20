layui.define(['easyHelper', 'jquery', 'form', 'xmSelect'], function (exports) {

    var $ = layui.$;
    var form = layui.form;
    var easyHelper = layui.easyHelper;
    var xmSelect = layui.xmSelect;

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
     * 创建checkbox选择器
     * @param config
     */
    function arrayCheckbox(config) {

        var defaults = {
            elem: '',
            name: 'checkbox',
            value: 'id',
            title: 'title',
            data: [],
        };

        var html = '';
        var options = $.extend(true, defaults, config);

        $.each(options.data, function (key, item) {
            html += '<input type="checkbox" ' + (item.checked === true ? 'checked' : '') + ' name="' + options.name + '[]" lay-skin="primary" title="' + item[options.title] + '" value="' + item[options.value] + '">';
        });

        $(options.elem).html(html);

        form.render('checkbox');
    }

    /**
     * 创建树结构选择器
     * @param el
     * @param data
     * @param selected
     * @param setting
     */
    function treeStruct(el, data, selected, setting) {

        var defaults = {
            data: {
                key: {
                    name: 'title'
                },
                simpleData: {
                    enable: true,
                    pIdKey: "parent_id",
                    rootPId: 0
                }
            },
            check: {
                enable: false
            },
            callback: {
                onClick: function (event, treeId, treeNode) {

                }
            },
            ready: function (tree) {

            }
        };

        var options = $.extend(true, defaults, setting);

        selected = easyHelper.stringToArray(selected, ',');

        /**
         * 循环设置选中的节点
         */
        $.each(data, function (key, item) {
            if (selected.indexOf(item.id.toString()) !== -1) {
                item.checked = true;
            }
        });

        options.ready($.fn.zTree.init($(el), options, data));
    }

    /**
     * 单列选择器
     * @param el
     * @param data
     * @param selected
     * @param setting
     */
    function singleSelect(el, data, selected, setting) {

        $.each(data, function (key, item) {
            item.parent_id = 0;
        });

        treeSelect(el, data, selected, setting);
    }

    /**
     * 构建树形选择器
     * @param el
     * @param data
     * @param selected
     * @param setting
     */
    function treeSelect(el, data, selected, setting) {

        var defaults = {
            el: el,
            data: data,
            name: '',
            radio: true,
            clickClose: true,
            height: "450px",
            disabled: false,
            prop: {
                name: 'title',
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
            },
            on: function (data) {

            },
            ready: function (tree) {

            },
            appendFirst: false,
            appendFirstData: {}
        };


        var options = $.extend(true, defaults, setting);

        options.tree.expandedKeys = getParentsId(options.data, selected);

        options.data = easyHelper.arrayToTree(options.data, 0, function (item) {
            if (options.appendFirst === true && easyHelper.equalsInt(item.id, selected)) {
                item.selected = true;
            }

            if (options.appendFirst === false && easyHelper.equalsInt(item.id, selected)) {
                item.selected = true;
            }
        });

        /**
         * 是否附加顶级数据
         */
        if (options.appendFirst) {
            if (easyHelper.equalsInt(selected, 0)) {
                options.appendFirstData.selected = true;
            }
            options.data.unshift(options.appendFirstData);
        }

        options.ready(xmSelect.render(options));
    }

    exports("easyBuilder", {
        treeStruct: treeStruct,
        treeSelect: treeSelect,
        singleSelect: singleSelect,
        arrayCheckbox: arrayCheckbox,
    });
});