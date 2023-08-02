layui.define(['jquery'], function (exports) {

    /**
     * 判断两个整数或字符串整数是否相等
     * @param number1
     * @param number2
     * @returns {boolean}
     */
    function equalsInt(number1, number2) {
        return parseInt(number1) === parseInt(number2);
    }

    /**
     * 字符串转数组
     * @param data
     * @param symbol
     * @returns {*}
     */
    function stringToArray(data, symbol) {
        return data ? data.split(symbol) : []
    }

    /**
     * 数组转树形结构
     * @param data
     * @param parentId
     * @param callFunction
     * @returns {[]}
     */
    function arrayToTree(data, parentId = 0, callFunction) {
        var result = [];

        $.each(data, function (key, item) {
            if (equalsInt(item.parent_id, parentId)) {
                item.children = arrayToTree(data, item.id);
                result.push(item);
            }

            typeof callFunction === "function" && callFunction(item);
        });

        return result;
    }

    /**
     * 查找
     * @param data
     * @param id
     */
    function arrayFindItem(data, id) {

        for (var i = 0; i < data.length; i++) {
            if (equalsInt(data[i].id) === equalsInt(id)) {
                return data[i];
            }
        }

        return false;
    }

    /**
     * 查找索引
     * @param data
     * @param id
     */
    function arrayFindIndex(data, id) {

        for (var i = 0; i < data.length; i++) {
            if (equalsInt(data[i].id) === equalsInt(id)) {
                return i;
            }
        }

        return false;
    }

    /**
     * 获取所有父级元素
     * @param data
     * @param parentId
     * @returns {[]}
     */
    function getParents(data, parentId) {

        var result = [];

        $.each(data, function (key, item) {
            if (equalsInt(item.id, parentId)) {
                result.push(item);
                getParents(data, item.parent_id);
            }
        });

        return result;
    }

    /**
     * 获取数组对象的某一列
     * @param data
     * @param field
     * @returns {[]}
     */
    function objectColumn(data, field) {
        return $.map(data, function (item) {
            return item[field];
        });
    }

    /**
     * 节流函数
     * @param fn
     * @param wait
     * @returns {Function}
     */
    function throttle(fn, wait) {
        var timer = null;
        return function () {
            var context = this, args = arguments;
            if (!timer) {
                timer = setTimeout(function () {
                    fn.apply(context, args);
                    timer = null;
                }, wait)
            }
        }
    }

    /**
     * 数组位置交换
     * @returns {*}
     */
    function swapArray(data, key, index) {

        if (data[index]) {
            data[key] = data.splice(index, 1, data[key])[0];
        }

        return data;
    }

    /**
     * base64转object对象
     * @param base64
     */
    function base64ToObject(base64) {
        return JSON.parse($.base64.decode(base64));
    }

    /**
     * 获取数组第一个
     * @param data
     * @returns {*}
     */
    function arrayFirst(data) {
        return data[0];
    }

    /**
     * 获取数组最后一个
     * @param data
     * @returns {*}
     */
    function arrayLast(data) {
        return data[data.length - 1];
    }

    exports("easyHelper", {
        throttle: throttle,
        arrayLast: arrayLast,
        arrayFirst: arrayFirst,
        equalsInt: equalsInt,
        swapArray: swapArray,
        getParents: getParents,
        arrayToTree: arrayToTree,
        objectColumn: objectColumn,
        stringToArray: stringToArray,
        arrayFindItem: arrayFindItem,
        arrayFindIndex: arrayFindIndex,
        base64ToObject: base64ToObject
    });
});