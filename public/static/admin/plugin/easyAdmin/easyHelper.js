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

    exports("easyHelper", {
        equalsInt: equalsInt,
        getParents: getParents,
        arrayToTree: arrayToTree,
        objectColumn: objectColumn,
        stringToArray: stringToArray,
        arrayFindItem: arrayFindItem
    });
});