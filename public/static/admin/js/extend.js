/**
 * jq 扩展函数文件
 */

(function ($) {
    /**
     * 获取checkbox值
     * @return array 返回数组格式
     */
    $.fn.checkBoxVal = function () {
        var result = [];
        for (var i = 0; i < this.length; i++) {
            if ($(this[i]).prop('checked')) {
                result.push($(this[i]).val());
            }
        }
        return result;
    }
})($);