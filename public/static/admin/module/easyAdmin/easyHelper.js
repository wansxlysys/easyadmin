layui.define(function (exports) {

    const easyHelper = {};

    /**
     * 数组转树形结构
     * @param options
     * @param arrayList
     * @returns {[]}
     */
    easyHelper.arrayToTree = (options, arrayList) => {

        const map = {};
        const result = [];

        arrayList.forEach(item => {
            map[item[options.prop.idKey]] = item;
        });

        arrayList.forEach(item => {

            const parent = map[item[options.prop.pidKey]];

            if (parent) {
                (parent.children || (parent.children = [])).push(item);
            } else {
                result.push(item);
            }

            if (options.handler) {
                options.handler(item);
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
            return item[field];
        });
    }

    /**
     * 节流
     * @param func
     * @param wait
     * @returns {function(...[*]=)}
     */
    easyHelper.throttle = (func, wait) => {
        let timeout;
        return function () {
            let context = this;
            let args = arguments;
            if (!timeout) {
                timeout = setTimeout(() => {
                    timeout = null;
                    func.apply(context, args);
                }, wait);
            }
        }
    }

    /**
     * 防抖
     * @param func
     * @param wait
     * @returns {function(...[*]=)}
     */
    easyHelper.debounce = (func, wait) => {
        let timeout;
        return function () {
            let context = this;
            let args = arguments;

            if (timeout) clearTimeout(timeout);

            timeout = setTimeout(() => {
                func.apply(context, args)
            }, wait);
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