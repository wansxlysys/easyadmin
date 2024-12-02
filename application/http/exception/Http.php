<?php


namespace app\http\exception;


use Exception;

use think\facade\Env;
use think\facade\Config;
use think\facade\Request;
use think\exception\Handle;
use think\exception\HttpException;

use app\common\exception\ValidateException;

class Http extends Handle
{
    /**
     * 忽略上报
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        ValidateException::class
    ];

    /*
     * 异常处理
     */
    public function render(Exception $e)
    {
        /**
         * 非调试模式设置
         */
        if (!Config::get('app.app_debug')) {

            /**
             * 非http异常返回500页面
             */
            if (false === ($e instanceof HttpException)) {
                Config::set('app.exception_tmpl', Env::get('app_path') . 'common/view/system/exception.php');
            }
        }

        /**
         * AJAX请求返回JSON
         */
        if (Request::isAjax()) {
            return json(['code' => 0, 'msg' => $e->getMessage(), 'data' => []]);
        }

        return parent::render($e);
    }
}