<?php


namespace app\index\controller;


use Throwable;
use rpc\RpcServer;
use think\Request;
use think\facade\Config;
use think\response\Json;
use app\index\rpc\UserServer;
use app\common\rpc\UserClient;

class IndexController
{
    /**
     * 首页
     * @return string
     */
    public function index_action()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    /**
     * rpc服务
     * @param Request $request
     * @return Json
     */
    public function server_action(Request $request)
    {
        try {

            $RpcServer = new RpcServer();

            /**
             * 本地配置
             */
            $RpcServer->setRpcKey(Config::get('rpc.key'));
            $RpcServer->addServer('userServer', UserServer::class);

            /**
             * 请求传入
             */
            $RpcServer->setParams($request->post());
            $RpcServer->setReqKey($request->get('reqkey'));
            $RpcServer->setTarget($request->get('target'));
            $RpcServer->setMethod($request->get('method'));

            return json($RpcServer->dispatch(), 500);

        } catch (Throwable $throwable) {
            return json($throwable->getMessage(), 500);
        }
    }

    /**
     * rpc测试
     * @param Request $request
     * @throws Throwable
     */
    public function client_action(Request $request)
    {
        $UserClient = new UserClient();

        dump($UserClient->getUserById(1));
    }
}
