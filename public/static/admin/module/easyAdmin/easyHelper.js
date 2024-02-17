layui.define(function (exports) {

    const easyHelper = {};

    /**
     * 数组转树形结构
     * @param data
     * @param callFunction
     * @returns {[]}
     */
    easyHelper.arrayToTree = (data, callFunction) => {

        var map = {};
        var result = [];

        $.each(data, function (key, item) {
            map[item.id] = item;
        });

        $.each(data, function (key, item) {

            var parent = map[item.parent_id];

            if (parent) {
                (parent.children || (parent.children = [])).push(item);
            } else {
                result.push(item);
            }

            typeof callFunction === "function" && callFunction(item);
        });

        return result;
    }

    /**
     * 获取所有父级元素
     * @param data
     * @param parentId
     * @returns {[]}
     */
    easyHelper.getParents = (data, parentId) => {

        var result = [];

        $.each(data, function (key, item) {
            if (item.id == parentId) {
                result.push(item);
                easyHelper.getParents(data, item.parent_id);
            }
        });

        return result;
    }

    /**
     * 获取数组对象的某一列
     * @param array
     * @param field
     * @returns {[]}
     */
    easyHelper.objectColumn = (array, field) => {
        return array.map(item => {
            return item[field]
        })
    }

    /**
     * 节流函数
     * @param fn
     * @param wait
     * @returns {Function}
     */
    easyHelper.throttle = (fn, wait) => {
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
     * base64转js
     * @param base64
     */
    easyHelper.base64ToJs = (base64) => {
        return JSON.parse(Base64.decode(base64));
    }

    exports("easyHelper", easyHelper);
});