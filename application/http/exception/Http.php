<?php


namespace app\http\exception;


use think\facade\Env;
use think\facade\Config;
use think\exception\HttpException;

class Http extends \think\exception\Handle
{
    /*
     * 异常处理
     */
    public function render(\Exception $exception)
    {
        /**
         * 非调试模式
         */
        if (!Config::get('app.app_debug')) {

            /**
             * 非http异常，报错信息全部隐藏
             */
            if (false === ($exception instanceof HttpException)) {
                Config::set('app.exception_tmpl', Env::get('app_path') . 'common/view/exception.html');
            }
        }

        return parent::render($exception);
    }
}