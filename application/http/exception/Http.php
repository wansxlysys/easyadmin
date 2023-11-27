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
             * AJAX请求返回JSON
             */
            if (Request::isAjax()) {
                return json(['code' => 0, 'msg' => $exception->getMessage(), 'data' => []]);
            }

            /**
             * 非http异常返回500页面
             */
            if (false === ($exception instanceof HttpException)) {
                Config::set('app.exception_tmpl', Env::get('app_path') . 'common/view/system/exception.html');
            }
        }

        return parent::render($exception);
    }
}