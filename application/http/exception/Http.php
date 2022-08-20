<?php


namespace app\http\exception;


class Http extends \think\exception\Handle
{

    public function render(\Exception $e)
    {
//        // 系统异常
//        if ($e instanceof \think\Exception) {
//            $result = ['code' => 0, 'msg' => $e->getMessage()];
//            return json($result);
//        }
//
//        // 页面不存在
//        if ($e instanceof \think\exception\HttpException) {
//            $result = ['code' => 404, 'msg' => $e->getMessage()];
//            return json($result);
//        }

        //可以在此交由系统处理
        return parent::render($e);
    }
}