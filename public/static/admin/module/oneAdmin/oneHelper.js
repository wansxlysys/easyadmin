layui.define(function (exports) {

    const oneHelper = {};

    /**
     * 数组转树形结构
     */
    oneHelper.arrayToTree = (options, arrayList) => {

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
     */
    oneHelper.objectColumn = (array, field) => {
        return array.map(item => {
            return item[field];
        });
    }

    /**
     * 数组交换位置
     */
    oneHelper.arraySwap = (array, a, b) => {
        const temp = array[a];
        array[a] = array[b];
        array[b] = temp;
        return array;
    }

    /**
     * 文件字节转MB和GB
     */
    oneHelper.formatFileSize = function (bytes) {
        if (bytes === 0) {
            return bytes + 'MB';
        }

        const MB = 1024 * 1024;
        const GB = 1024 * 1024 * 1024;

        if (bytes < GB) {
            const sizeInMB = bytes / MB;
            return sizeInMB.toFixed(2) + 'MB';
        } else {
            const sizeInGB = bytes / GB;
            return sizeInGB.toFixed(2) + 'GB';
        }
    }

    exports("oneHelper", oneHelper);
});