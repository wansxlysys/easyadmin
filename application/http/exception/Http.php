<?php


namespace app\http\exception;


use Exception;
use think\facade\Env;
use think\facade\Config;
use think\facade\Request;
use think\exception\Handle;
use think\exception\HttpException;

class Http extends Handle
{
    /*
     * 异常处理
     */
    public function render(Exception $exception)
    {
        /**
         * 非调试模式设置
         */
        if (!Config::get('app.app_debug')) {

            /**
             * 非http异常，报错信息全部隐藏
             */
            if (false === ($exception instanceof HttpException)) {
                Config::set('app.exception_tmpl', Env::get('app_path') . 'common/view/system/exception.html');
            }

            /**
             * 如果是AJAX请求，则返回JSON
             */
            if (Request::isAjax()) {
                return json(['code' => 0, 'msg' => $exception->getMessage(), 'data' => []]);
            }
        }

        return parent::render($exception);
    }
}