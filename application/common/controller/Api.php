<?php


namespace app\common\controller;


use think\response\Json;

/**
 * 接口基类
 * @package app\common\controller
 */
class Api extends \think\Controller
{
    /**
     * 返回接口数据格式
     * @param $code
     * @param $msg
     * @param $data
     * @return Json
     */
    protected function json($code, $msg, $data = [])
    {
        $result['msg']  = $msg;
        $result['code'] = $code;
        $result['data'] = $data;

        return json($result);
    }

    /**
     * 成功返回
     * @param string $msg
     * @param array $data
     * @return Json
     */
    protected function pass($msg = '操作成功', $data = [])
    {
        return $this->json(200, $msg, $data);
    }

    /**
     * 失败返回
     * @param string $msg
     * @param array $data
     * @return Json
     */
    protected function fail($msg = '操作失败', $data = [])
    {
        return $this->json(400, $msg, $data);
    }
}