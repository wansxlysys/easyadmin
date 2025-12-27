layui.define(function (exports) {

    const easyHelper = {};

    /**
     * 数组转树形结构
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
     */
    easyHelper.objectColumn = (array, field) => {
        return array.map(item => {
            return item[field];
        });
    }

    /**
     * 节流
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
     */
    easyHelper.debounce = (func, wait) => {
        let timeout;
        return function () {
            let context = this;
            let args = arguments;
            if (timeout) {
                clearTimeout(timeout);
            }
            timeout = setTimeout(() => {
                func.apply(context, args)
            }, wait);
        }
    }

    /**
     * 数组交换位置
     */
    easyHelper.arraySwap = (array, a, b) => {
        const temp = array[a];
        array[a] = array[b];
        array[b] = temp;
        return array;
    }

    /**
     * 文件字节转MB和GB
     */
    easyHelper.formatFileSize = function (bytes) {
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

    /**
     * 计算文件MD5
     */
    easyHelper.calculateFileMD5 = (file, chunkSize = 2 * 1024 * 1024) => {
        return new Promise((resolve, reject) => {
            const spark = new SparkMD5.ArrayBuffer();
            const fileReader = new FileReader();
            const chunks = Math.ceil(file.size / chunkSize);
            let currentChunk = 0;

            function loadNext() {
                const start = currentChunk * chunkSize;
                const end = Math.min(start + chunkSize, file.size);
                const slice = file.slice(start, end);

                fileReader.readAsArrayBuffer(slice);
            }

            fileReader.onload = function (e) {
                spark.append(e.target.result);
                currentChunk++;

                if (currentChunk < chunks) {
                    loadNext();
                } else {
                    resolve(spark.end());
                }
            };

            fileReader.onerror = function () {
                reject(new Error('文件读取失败'));
            };

            loadNext();
        });
    }

    exports("easyHelper", easyHelper);
});